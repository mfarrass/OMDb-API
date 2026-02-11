let loading = false;
let noMoreMovies = false;

window.addEventListener("scroll", () => {

    if (loading || noMoreMovies) return;

    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 400){
        loadMoreMovies();
    }

});

function loadMoreMovies(){

    const pageInput   = document.getElementById("current-page");
    const searchInput = document.getElementById("current-search");
    const loader      = document.getElementById("scroll-loader");

    if(!pageInput || !searchInput) return;

    loading = true;
    loader.style.display = "flex";

    let page   = parseInt(pageInput.value) + 1;
    let search = searchInput.value;

    fetch(`/movies/load?search=${search}&page=${page}`)
    .then(res => res.json())
    .then(data => {

        if(data.length === 0){

            loader.innerHTML = `
                <div class="no-more">
                    🎬 No more movies
                </div>
            `;

            noMoreMovies = true;
            return;
        }

        const list = document.getElementById("movie-list");

        data.forEach(movie => {

            const html = `
            <div class="col-3 movie-card">
                <a href="/movie-detail?imdbID=${movie.imdbID}" class="movie-item">
                    <img 
                        src="${movie.PosterHD}"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://dummyimage.com/600x900/111/fff&text=No+Image';"
                        class="movie-poster">

                    <div class="movie-item-content">
                        <div class="movie-item-title">
                            ${movie.Title}
                        </div>
                        <div class="movie-infos">
                            <div class="movie-info">${movie.Year}</div>
                            <div class="movie-info">${movie.Type}</div>
                        </div>
                    </div>
                </a>
            </div>
            `;

            list.insertAdjacentHTML("beforeend", html);
        });

        pageInput.value = page;
        loading = false;
        loader.style.display = "none";

    });

}
