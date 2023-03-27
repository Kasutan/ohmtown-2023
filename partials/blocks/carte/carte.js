const TABLIST = document.querySelector("[role='tablist']");
const TABS = [...TABLIST.querySelectorAll("[role='tab']")];
const TABPANELS = [...document.querySelectorAll("[role='tabpanel']")];

const createKeyboardNavigation = () => {
const firstTab = TABS[0];
const lastTab = TABS[TABS.length - 1];

TABS.forEach((element) => {
	element.addEventListener("keydown", function (e) {
	if (e.key === "ArrowUp" || e.key === "ArrowLeft") {
		e.preventDefault();
		if (element == firstTab) {
		lastTab.focus();
		} else {
		const focusableElement = TABS.indexOf(element) - 1;
		TABS[focusableElement].focus();
		}
	} else if (e.key === "ArrowDown" || e.key === "ArrowRight") {
		e.preventDefault();
		if (element == lastTab) {
		firstTab.focus();
		} else {
		const focusableElement = TABS.indexOf(element) + 1;
		TABS[focusableElement].focus();
		}
	} else if (e.key === "Home") {
		e.preventDefault();
		firstTab.focus()
	} else if (e.key === "End") {
		e.preventDefault();
		lastTab.focus()
	}
	});
});
};

const showActivePanel = (element) => {
const selectedId = element.target.id;
TABPANELS.forEach((e) => {
	e.hidden = "true";
});
const activePanel = document.querySelector(
	`[aria-labelledby="${selectedId}"]`
);
activePanel.removeAttribute("hidden");
};

const handleSelectedTab = (element) => {
const selectedId = element.target.id;
TABS.forEach((e) => {
	const id = e.getAttribute("id");
	if (id === selectedId) {
	e.removeAttribute("tabindex", "0");
	e.setAttribute("aria-selected", "true");
	} else {
	e.setAttribute("tabindex", "-1");
	e.setAttribute("aria-selected", "false");
	}
});
};

createKeyboardNavigation();

TABS.forEach((element) => {
element.addEventListener("click", (element) => {
	showActivePanel(element), handleSelectedTab(element);
});

element.addEventListener("focus", (element) => {
	showActivePanel(element), handleSelectedTab(element);
});
});
