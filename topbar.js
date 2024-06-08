
  class TopBar extends HTMLElement {
    connectedCallback() {
      this.innerHTML = `
    <style>
    @import "css/mystyle.css";
    </style>
      <div class="topnav">'
        <a class="active" href="#home">Home</a>
        <div class="topnav-right">
          <a href="register.html">Register</a>
          <a href="login.html">Login</a>
        </div>
      </div>
    `;

    }
  }
  window.customElements.define('topbar-component', TopBar);
