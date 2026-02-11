    const dropdown = document.querySelector(".lang-dropdown");
    const selected = document.getElementById("selected-lang");
    const items = document.querySelectorAll(".lang-item");

    const flag = document.getElementById("selected-flag");
    const text = document.getElementById("selected-text");

    selected.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdown.classList.toggle("active");
    });

    items.forEach(item => {
        item.addEventListener("click", () => {

            const newLang = item.dataset.lang;
            const newFlag = item.dataset.flag;

            text.innerText = newLang;
            flag.src = newFlag;

            dropdown.classList.remove("active");

            localStorage.setItem("lang", newLang);
            localStorage.setItem("flag", newFlag);
        });
    });

    document.addEventListener("click", () => {
        dropdown.classList.remove("active");
    });

    const savedLang = localStorage.getItem("lang");
    const savedFlag = localStorage.getItem("flag");

    if(savedLang && savedFlag){
        text.innerText = savedLang;
        flag.src = savedFlag;
    }