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
        .get(`projects/api`)
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
                        { project.image ?
                        <Card.Img variant="top" src={require('../../images/' + project.image)} style={{ height: "15rem"}} />
                        : <Card.Img variant="top" src={ cloud } style={{ height: "15rem"}} />
                        }
                        <Card.Body>
                            <Card.Title>{project.name}</Card.Title>
                            <Card.Text>{project.description}</Card.Text>
                            { project.link ?
                                <Button href={project.link} className="card_button" >Lien
                                    { project.screen ?
                                        <img src={require('../../images/' + project.screen.image)} alt="screen" width="30" height="30"/>
                                        : ""
                                    }
                                </Button>
                                : "" }
                            { project.github ?
                                <a href={project.github} target="_blank">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="github" width="40" height="40"/>
                                </a>
                                : ""
                            }
                        </Card.Body>
                        <Card.Footer>
                            {project.languages.map((language, idx) => (
                                <img key={idx} src={ language.image } alt={ language.name } width="40" height="40"/>
                            ))}
                        </Card.Footer>
                        <Card.Footer>
                        {project.tools.map((tool, idx) => (
                                <img key={idx} src={ tool.image } alt={ tool.name } width="40" height="40"/>
                            ))}
                        </Card.Footer>
                    </Card>
                    ))}
                </div>
            </div>
        </div>
       
    )
}