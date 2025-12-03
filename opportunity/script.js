// Permite utilizar un elemento facilmente
const getElement = selector => document.querySelector(selector);
    document.addEventListener("DOMContentLoaded", () => {
        const cards = document.querySelectorAll(".card");

        // Evento que abrira un popup al seleccionar un card de una oportunidad
        const overlay = getElement("#overlay");
        const modal = getElement("#cardExpandida");

        const cerrar = () => {
            modal.style.display = "none";
            overlay.style.display = "none";
        }

        // Colocar la informacion de la oportunidad escogidad en el popup
        cards.forEach(card => {
            card.addEventListener("click", () => {
                // Se obtienen los datos del card
                const title = card.dataset.title;
                const typeName = card.dataset.type_name;
                const sponsor = card.dataset.sponsor;
                const datePostedFormat = card.dataset.date_posted_format;
                const deadline = card.dataset.deadline;
                const author = card.dataset.author;
                const url = card.dataset.url;
                const attachment = card.dataset.attachment;
                const fileName = card.dataset.file_name;
                const description = card.dataset.description;

                // Se colocan los datos en el popup
                getElement("#opp-title").textContent = title;
                getElement("#opp-type").textContent = typeName;
                getElement("#opp-sponsor").textContent = sponsor;
                getElement("#opp-date-posted-format").textContent = datePostedFormat;
                getElement("#opp-deadline").textContent = deadline;
                getElement("#opp-author").textContent = author;
                getElement("#opp-url").textContent = url;
                getElement("#opp-url").href = url;
                getElement("#opp-attachment").textContent = fileName;
                getElement("#opp-attachment").href = "https://ccom.upra.edu/~vegrivjo/ccom4019/proyect/files/" + fileName;
                getElement("#opp-description").innerHTML = description;

                // Muestra el popup
                modal.style.display = "block";
                overlay.style.display = "block";
            });
        });

        // Cierra el popup
        getElement("#cerrarCard").addEventListener("click", cerrar);
        overlay.addEventListener("click", cerrar);

        // Funcion para verificar si hay un filtro activo, y 
        // verificar si tiene el mismo valor
        const selectFilterCards = (card) => {
            const jobs = getElement("#jobs");
            const internship = getElement("#internship");
            const fellowships = getElement("#fellowships");
            const project = getElement("#project");
            const type = card.dataset.type;

            if(jobs.checked && type == jobs.value)
                return true;
            if(internship.checked && type == internship.value)
                return true;
            if(fellowships.checked && type == fellowships.value)
                return true;
            if(project.checked && type == project.value)
                return true;

            return false;
        }

        // Funcion para ver si hay un filtro activo
        const filterActive = () => {
            return getElement("#jobs").checked ||
                    getElement("#internship").checked ||
                    getElement("#fellowships").checked ||
                    getElement("#project").checked ||
                    getElement("#recent").checked ||
                    getElement("#old").checked;
        }

        // Funcion para limpiar todos los filtros
        const cleanFilter = () => {
            getElement("#jobs").checked = false;
            getElement("#internship").checked = false;
            getElement("#fellowships").checked = false;
            getElement("#project").checked = false;
            getElement("#recent").checked = false;
            getElement("#old").checked = false;
        }

        // Funcion que ordenara los cards, y lo devolvera ordenado
        const sortDate = (array) =>{
            //Ordenara de la fecha mas nueva a la mas vieja
            if(getElement("#recent").checked){
                return array.sort((a, b) => {
                    return new Date(b.dataset['date_posted']) - new Date(a.dataset['date_posted']);
                });
            }
            //Ordenara de la fecha mas vieja a la mas nueva
            else if (getElement("#old").checked){
                return  array.sort((a, b) => {
                    return new Date(a.dataset['date_posted']) - new Date(b.dataset['date_posted']);
                });
            }

            return array;
        }

        // Evento para manejar los filtros de las oportunidades
        getElement("#save-filter").addEventListener("click", () => {
            const grid = getElement(".grid");

            // Hay un filtro activado
            if(filterActive()){  
                const cardsFilters = Array.from(cards).filter(card => selectFilterCards(card));

                console.log(cardsFilters)
                console.log(cardsFilters.length)

                
                // Utiliza el arreglo con los filtros
                if(cardsFilters.length > 0){
                    const sortedCards = Array.from(sortDate(cardsFilters));

                    Array.from(cards).forEach(card => {
                        card.style.display = 'none';
                    });

                    // Añade cada card en la pantalla
                    sortedCards.forEach(card => {
                        card.style.display = 'block';
                        grid.appendChild(card);
                    });
                }
                else if (getElement("#recent").checked || getElement("#old").checked){
                    const sortedCards = Array.from(sortDate(Array.from(cards)));

                    Array.from(cards).forEach(card => {
                        card.style.display = 'none';
                    });

                    // Añade cada card en la pantalla
                    sortedCards.forEach(card => {
                        card.style.display = 'block';
                        grid.appendChild(card);
                    });
                }
                else {
                    Array.from(cards).forEach(card => {
                        card.style.display = 'none';
                    });
                }
            }
            else {
                Array.from(cards).forEach(card => {
                    card.style.display = 'block';
                });
            }
        });

        // Evento para inicializarlo efectos
        getElement("#clean-filter").addEventListener("click", () => {
            cleanFilter();
            Array.from(cards).forEach(card => {
                card.style.display = 'block';
            });
        });


        // Parte del search
        const searchInput = getElement("#search-input");
        const searchBtn = getElement("#search-btn");

        // Funcion que compara lo que se entro con la
        // informacion que tiene los cards
        const searchCards = () => {
            const query = searchInput.value.trim().toLowerCase();

            Array.from(cards).forEach(card => {
                const title = card.dataset.title.toLowerCase();
                const sponsor = card.dataset.sponsor.toLowerCase();
                const description = card.dataset.description.toLowerCase();
                const typeName = card.dataset.type_name.toLowerCase();
                const author = card.dataset.author.toLowerCase();

                // Mostrar si el query aparece en alguno de los campos
                if (
                    title.includes(query) ||
                    sponsor.includes(query) ||
                    description.includes(query) ||
                    typeName.includes(query) ||
                    author.includes(query)
                ) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        };

        // Buscar al hacer click
        searchBtn.addEventListener("click", searchCards);
    });
