let fabScrollTop;
let themeChanger;

window.addEventListener('DOMContentLoaded', ()=>{
	fabScrollTop = document.getElementById("goTop");
	themeChanger = document.getElementById("themeChanger");
	let currentTheme = localStorage.getItem("theme");
	if (!currentTheme) {
		let theme = userPrefersDarkTheme() ? "dark" : "light";
		localStorage.setItem("theme", theme);
		themeChanger.selected = userPrefersDarkTheme() ? false : true;
		currentTheme = theme;
	}
	themeChanger.addEventListener('click', ()=>{
		toggleTheme();
	});
	setTheme(currentTheme);
	let selectedLang = document.body.getAttribute("display-lang") ?? "en";
	console.log(selectedLang);
	if (selectedLang == "es-419") {
		document.getElementById("langChange").selected = true;
		document.getElementById("langChange").setAttribute("href", "en");
	} else {
		document.getElementById("langChange").selected = false;
		document.getElementById("langChange").setAttribute("href", "es");
	}
});

window.addEventListener('themeChanged', ()=>{
	let linkTag = document.createElement("link");
	linkTag.rel = "stylesheet";
	linkTag.setAttribute("current-theme", "");
	let currentTheme = localStorage.getItem("theme") ?? "light";
	if (currentTheme == "dark") {
		linkTag.href = window.location.origin + "/dotdager/public/store-long/Styles/dark.css";
		themeChanger.selected = false;
	} else {
		linkTag.href = window.location.origin + "/dotdager/public/store-long/Styles/light.css";
		themeChanger.selected = true;
	}
	let currentTag = document.querySelector("link[current-theme]");
	if (currentTag) {
		currentTag.remove();
	}
	document.head.appendChild(linkTag);
});

window.addEventListener('scroll', ()=>{
	if (window.scrollY > 0) {
		fabScrollTop.style.display = "block";
	} else {
		fabScrollTop.style.display = "none";
	}
});

function userPrefersDarkTheme(){
	return window.matchMedia("(prefers-color-scheme: dark)").matches
}

function setTheme(theme){
	localStorage.setItem("theme", theme);
	window.dispatchEvent(new Event("themeChanged"))
}

function toggleTheme(){
	let currentTheme = localStorage.getItem("theme");
	if (currentTheme == "dark") {
		localStorage.setItem("theme", "light");
	} else {
		localStorage.setItem("theme", "dark");
	}
	setTheme(localStorage.getItem("theme"));
}