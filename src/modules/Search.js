import axios from 'axios';

class Search {
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = document.querySelector("#search-overlay__results");
    this.openButton = document.querySelectorAll(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector("#search-term");
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
    this.events();  
 }

  events() {
    this.openButton.forEach(el => {
        el.addEventListener("click", e => {
          e.preventDefault()
          this.openOverlay()
        })
      })
    this.closeButton.addEventListener('click', this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener('keyup', this.typingLogic.bind(this));
  }

  typingLogic() {
    if (this.searchField.value !== this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.innerHTML = '';
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.value;
  }

  getResults() {
    axios
      .get(`${siteData.root_url}/wp-json/mamiejacquotte/v1/search?term=${this.searchField.value}`)
      .then((response) => {
        const results = response.data;
        this.resultsDiv.innerHTML = `
          <div class="row">
            <div class="one-third">
              <h2 class="search-overlay__section-title">Résultats des recettes</h2>
              ${
                results.generalInfo.length
                  ? '<ul class="link-list min-list">'
                  : '<p>Aucune recette correspondante !</p>'
              }
              ${results.generalInfo
                .map(
                  (item) =>
                    `<li>
                      <a href="${item.permalink}">
                        ${
                          item.postType === 'post'
                            ? `<span><img class="blog_index_image" src="${item.thumbnail}"></span>`
                            : ''
                        }
                        ${item.title}
                      </a>
                    </li>`
                )
                .join('')}
              ${results.generalInfo.length ? '</ul>' : ''}
            </div>
          </div>
        `;
        this.isSpinnerVisible = false;
      })
      .catch((error) => {
        console.error(error);
        this.isSpinnerVisible = false;
      });
  }

  keyPressDispatcher(e) {
    if (e.keyCode === 83 && !this.isOverlayOpen && !document.querySelector("input, textarea").matches(':focus')) {
      this.openOverlay();
    }
    if (e.keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    document.body.classList.add("body-no-scroll");
    this.searchField.value = '';
    setTimeout(() => this.searchField.focus(), 301);
    this.isOverlayOpen = true;
    return false;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    document.body.classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    const searchHTML = `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <span class="my-search-svg my-search-svg-opened">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>
            </span>
            <input type="text" class="search-term" placeholder="Que recherchez-vous?" id="search-term" autocomplete="off">
            <div>
              <svg class="search-overlay__close" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
              </svg>
            </div>
          </div>
        </div>
        <div>
          <div class="container" id="search-overlay__results"></div>
        </div>
      </div>
    `;
    document.body.insertAdjacentHTML('beforeend', searchHTML);
  }
}

export default Search;