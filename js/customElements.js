class NavigationBar extends HTMLElement {
    constructor() {
        super();
        this.innerHTML = `<nav class="navbar navbar-expand-lg" style="background-color:#00274C">
    <div class="container">
        <a href="home.html" class="navbar-brand" style="color:#FFCB05">Better Degree Works</a>
        <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a href="AdvicePage.html" class="nav-link" style="color:#FFCB05">Advice</a>
                </li>
                <li class="nav-item ">
                    <a href="GetClasses.html" class="nav-link" style="color:#FFCB05">Get Classes</a>
                </li>
                <li class="nav-item">
                    <a href="CurriculumSheets.html" class="nav-link" style="color:#FFCB05">Curriculum Sheets</a>
                </li>
                <li class="nav-item">
                    <a href="HelpPage.html" class="nav-link" style="color:#FFCB05">Help Page</a>
                </li>
            </ul>
            <help-button></help-button>
        </div>
    </div>
</nav>`;
    }
}


window.customElements.define('navigation-bar', NavigationBar);