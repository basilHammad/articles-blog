$(document).ready(() => {
  const url = window.location;
  $('#search-btn').click(() => {
    $('#search').toggle();
  });

  $('.form').submit(function (e) {
    return false;
  });
  function capitalizeFirstLetter(str) {
    const capitalized = str.charAt(0).toUpperCase() + str.slice(1);
    return capitalized;
  }

  $(document).on('click', '#load-more', function () {
    const id = $('#load-more').data('id');
    $.post(url, { id: id }, function (res) {
      const response = JSON.parse(res);
      if (response.articles.length === 0) $('#load-more').remove();

      if (response.page === 'pages/index') {
        const articles = response.articles.map((article) => {
          $('#load-more').data('id', article.id);
          return `
        <div class="card mb-5">
          <div class="img-wrapper mb-4">
            <a href="${response.URLROOT}articles/show/${article.id}">
              <img src="${response.URLROOT}img/article-imgs/${
            article.img
          }" alt="" />
            </a>
          </div>
          <a href="#"><strong>${capitalizeFirstLetter(
            article.category
          )}</strong></a>
          <h2 class="pt-4">${article.title}</h2>
          <p>${article.description}</p>
        </div>`;
        });

        articles.forEach((article) => {
          $('#articles-container').append(article);
        });
      } else {
        const articles = response.articles.map((article) => {
          console.log(response.articles.length === 0);
          $('#load-more').data('id', article.id);
          return ` 
            <div class="col-md-6">
              <div class="card-small">
              <div class="img-wrapper mb-3">
                <a href="${response.URLROOT}articles/show/${article.id}">
                    <img src="${response.URLROOT}img/article-imgs/${article.img}" alt="" />
                </a>
              </div>
              <h3>
                  ${article.title}
              </h3>
            </div>
          </div>
          `;
        });

        articles.forEach((article) => {
          $('#articles-container').append(article);
        });
      }
    });
  });
});
