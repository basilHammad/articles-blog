$(document).ready(() => {
  const url = window.location;
  const last_id = $('#last_id').val();

  $('#sidebar-search').click(() => {
    $('.side-bar-form').submit();
  });

  $('#sidebar-toggler').click(() => {
    const sidebar = $('.sidebar');
    const sidebarItems = Array.from(
      $('.side-bar-form, .register, .nav-items .nav-item').get()
    );
    sidebar.toggleClass('slide');
    if (sidebar.hasClass('open')) {
      sidebar.removeClass('open');
      sidebar.css({ transitionDelay: '1.5s' });
      sidebarItems.forEach((item, index) => {
        $(item)
          .css({ transitionDelay: index * 0.15 + 0.1 + 's' })
          .toggleClass('slide');
      });
    } else {
      sidebar.addClass('open');
      sidebar.css({ transitionDelay: '0s' });
      sidebarItems.forEach((item, index) => {
        $(item)
          .css({ transitionDelay: index * 0.15 + 0.1 + 's' })
          .toggleClass('slide');
      });
    }
  });

  $('#search-btn').click(() => {
    $('#search').toggle(200);
  });

  $('.form').submit(function (e) {
    return false;
  });

  function capitalizeFirstLetter(str) {
    const capitalized = str.charAt(0).toUpperCase() + str.slice(1);
    return capitalized;
  }

  $(document).on('click', '#load-more', function () {
    const id = $('#load_more_id').val();
    $.post(url, { id: id }, function (res) {
      const response = JSON.parse(res);
      if (response.page === 'pages/index') {
        const articles = response.articles.map((article) => {
          $('#load_more_id').val(article.id);
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
          <div class="card-link-wrapper d-flex justify-content-end">
          <a href="${response.URLROOT}articles/show/${
            article.id
          }" class="card-link text-success push-right">Read More</a>
        </div>

        </div>`;
        });

        if ($('#load_more_id').val() === last_id) $('#load-more').remove();

        articles.forEach((article) => {
          $('#articles-container').append(article);
        });
      } else {
        const articles = response.articles.map((article) => {
          $('#load_more_id').val(article.id);
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

        if ($('#load_more_id').val() === last_id) $('#load-more').remove();

        articles.forEach((article) => {
          $('#articles-container').append(article);
        });
      }
    });
  });

  const selectedCategory = $('#selected-category').val();
  const selectOptions = Array.from($('.form-group option').get());
  selectOptions.forEach((option) => {
    if (selectedCategory === $(option).attr('id'))
      $(option).attr('selected', 'selected');
  });
});
