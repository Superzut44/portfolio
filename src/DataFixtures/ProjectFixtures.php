<?PHP

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECTS = [
        [
            'name' => 'Marché Conclu',
            'description' => "Projet de création (du  1 décembre 2021 au 11 février 2022) d'un site Marché Conclu pour une cliente, en version mobile, réalisé en équipe à l'école Wild Code School de Reims.",
            'image' => 'marcheconclu.png',
            'link' => 'https://marcheconclu.chavaudreyxavier.fr',
            'github' => 'https://github.com/Superzut44/marche-conclu',
            'languages' => ['HTML', 'CSS', 'PHP', 'Javascript'],
            'tools' => ['Symfony', 'Sass', 'Bootstrap', 'MySQL', 'Composer', 'Git', 'Visual Studio Code', 'Linux'],
            'screenReference' => 'project_marcheconclu',
            'startThe' => '07-12-2021'
        ],
        [
            'name' => 'Fymi',
            'description' => "Hackaton sur le thème de la musique, réalisé en équipe et en version mobile (le 25 et 26 novembre 2021).",
            'image' => 'fymi.png',
            'link' => 'https://fymi.chavaudreyxavier.fr',
            'github' => 'https://github.com/Superzut44/fymi',
            'languages' => ['HTML', 'CSS', 'PHP'],
            'tools' => ['Symfony', 'MySQL', 'Git', 'Visual Studio Code', 'Linux'],
            'screenReference' => 'project_fymi',
            'startThe' => '25-11-2021'
        ],
        [
            'name' => 'Unlock',
            'description' => "Projet de création (du  21 oct au 13 nov 2021) d'un site fictif de type jeu : escape game ( Unlock! Sherlock adventures ), réalisé en équipe à l'école Wild Code School de Reims.",
            'image' => 'unlock.jpg',
            'link' => 'https://unlock.labetowiez.fr',
            'github' => 'https://github.com/Superzut44/unlock',
            'languages' => ['HTML', 'CSS', 'PHP'],
            'tools' => ['Symfony', 'MySQL', 'Git', 'Visual Studio Code', 'Linux'],
            'screenReference' => 'project_unlock',
            'startThe' => '26-10-2021'
        ],
        [
            'name' => 'Wild Post',
            'description' => "Création en équipe (du  28 sept au 8 oct 2021) d'un site fictif de type journal sur l'école Wild Code School de Reims.",
            'image' => 'wild-post.jpg',
            'link' => 'https://wildpost.chavaudreyxavier.fr',
            'github' => 'https://github.com/Superzut44/Wild-Post',
            'languages' => ['HTML', 'CSS'],
            'tools' => ['Git', 'Visual Studio Code', 'Linux'],
            'screenReference' => 'project_wildpost',
            'startThe' => '29-09-2021'
        ],
        [
            'name' => 'School schedule',
            'description' => "Création d'un emploi du temps scolaire (début septembre 2020) avec coloration du programme de la journée, qui varie en fonction des semaines A ou B.",
            'image' => 'school-schedule.jpg',
            'link' => 'https://school-schedule.chavaudreyxavier.fr',
            'github' => 'https://github.com/Superzut44/school-schedule',
            'languages' => ['HTML', 'CSS', 'Javascript'],
            'tools' => ['Codepen'],
            'screenReference' => 'project_school-schedule',
            'startThe' => '04-09-2020'
        ],
        [
            'name' => 'Angular',
            'description' => "Mon premier projet Angular.",
            'image' => 'angular.jpg',
            'link' => 'https://myfirstappangular.chavaudreyxavier.fr',
            'github' => 'https://github.com/Superzut44/MyFirstAppAngular',
            'languages' => ['HTML', 'CSS', 'Javascript', 'TypeScript'],
            'tools' => ['Angular', 'Node.js'],
            'screenReference' => 'project_angular',
            'startThe' => '05-05-2022'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROJECTS as $key => $projectData) {
            $project = new Project();
            $project->setName($projectData['name']);
            $project->setDescription($projectData['description']);
            $project->setImage($projectData['image']);
            $project->setLink($projectData['link']);
            $project->setGithub($projectData['github']);
            $this->addReference('project_' . $key, $project);
            foreach ($projectData['languages'] as $languageData) {
                $project->addLanguage($this->getReference('language_' . $languageData));
            };
            foreach ($projectData['tools'] as $toolData) {
                $project->addTool($this->getReference('tool_' . $toolData));
            };
            $this->addReference($projectData['screenReference'], $project);
            $project->setStartThe(new DateTimeImmutable($projectData['startThe']));

            $manager->persist($project);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ToolFixtures::class,
            LanguageFixtures::class
        ];
    }
}
