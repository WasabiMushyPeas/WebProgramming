function onThemeSwitch(){
    var currentTheme = document.documentElement.getAttribute("data-theme");
    if (currentTheme === "dark"){
        document.documentElement.setAttribute("data-theme", "light");
        document.getElementById("themeSwitcherIMG").src = "images/sun.png";
    }
    else{
        document.documentElement.setAttribute("data-theme", "dark");
        document.getElementById("themeSwitcherIMG").src = "images/moon.png";
    }
}