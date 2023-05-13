const mainimg = document.getElementsByClassName("mainimg")[0];
const bag1 = document.getElementsByClassName("bag1")[0];
const bag2 = document.getElementsByClassName("bag2")[0];
const bag3 = document.getElementsByClassName("bag3")[0];

bag1.addEventListener("click", () => {
    mainimg.src = bag1.src;
});

bag2.addEventListener("click", () => {
    mainimg.src = bag2.src;
});

bag3.addEventListener("click", () => {
    mainimg.src = bag3.src;
});

