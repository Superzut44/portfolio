import React, { useState, useEffect } from "react";
// https://create-react-app.dev/docs/adding-images-fonts-and-files/
// https://pixabay.com/
import cloud from '../../images/cloud.jpg';

// npm install react-bootstrap bootstrap@5.1.3
// composer install && composer update
import { } from 'react-bootstrap';

import { useMediaQuery } from 'react-responsive'

import { Card, Button } from 'react-bootstrap';

import axios from "axios";


// console.log(mobile); // /logo.84287d09.png

export default function Projects() {

    const isPortrait = useMediaQuery({ query: '(orientation: portrait)' })
    const [projects, setProjects] = useState([]);

    useEffect(() => {
        axios
        .get(`api/projects/test`)
        .then((resp) => {
            setProjects(resp.data);
        });
    }, []);
  
    return (
        <div className="projects">
            <div className={`projects-page ${!isPortrait ? "projects-page-classdesktop" : "projects-page-classmobile"}`}>
                {/* <img src={mobile} alt="digital world"/> */}
                {isPortrait ? 
                <><h1>Mes projets</h1><h2>réalisés</h2></> :
                <><h1>Mes projets réalisés</h1></>}
            </div>
            <div className="wrapper">
                    <div className="cards_wrap">
                    {projects.map((project, idx) => (
                        <Card key={idx} style={{ width: "30rem"}} className="card_margin">
                        <Card.Img variant="top" src={require('../../images/' + project.image)} style={{ height: "15rem"}} />
                        <Card.Body>
                            <Card.Title>{project.name}</Card.Title>
                            <Card.Text>{project.description}</Card.Text>
                            <Button href={project.link} className="card_button" >Link
                                <img src={require('../../images/' + project.icon)} alt="c" width="30" height="30"/>
                            </Button>
                            <a href={project.github} target="_blank">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="c" width="30" height="30"/>
                            </a>
                        </Card.Body>
                        <Card.Footer>
                            {console.log(project.language)}
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="js" width="30" height="30"/>
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="js" width="30" height="30"/>
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="php" width="30" height="30"/>
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original-wordmark.svg" alt="bootstrap" width="30" height="30" />
                        </Card.Footer>
                        <Card.Footer>
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="js" width="30" height="30"/>
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="php" width="30" height="30"/>
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original-wordmark.svg" alt="bootstrap" width="30" height="30" />
                        </Card.Footer>
                    </Card>
                    ))}
                </div>
            </div>
        </div>
       
    )
}