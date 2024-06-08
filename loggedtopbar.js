
  class LoggedTopBar extends HTMLElement {
    connectedCallback() {
      this.innerHTML = `
    <style>
    @import "css/mystyle.css";
    </style>
      <div class="topnav">'
        <a class="active" href="#home">Home</a>
        <a href="newpublication.php">New Publication</a>
        <a href="showpublication.php">Show</a>
        <a href="editpublication.php">Edit</a>
        <a href="deletepublication.php">Delete</a>
        <a href="multiplepublications.php">Multiple Publications</a>
        <a href="exportpublication.php">Export</a>
        <a href="searchpublication.php">Search</a>
        <a href="charts.php">Charts</a>
        <div class="topnav-right">
          <a href="logout.php">logout</a>
        </div>
      </div>
    `;

    }
  }
  window.customElements.define('loggedtopbar-component', LoggedTopBar);
