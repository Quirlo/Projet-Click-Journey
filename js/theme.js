document.addEventListener("DOMContentLoaded", () => {
  const themeLink = document.getElementById("theme-style");
  const themeToggle = document.getElementById("themeToggle");

  const path = themeLink.getAttribute("href");
  const filename = path.split("/").pop();
  const baseName = filename.replace(".css", "").replace("_dark", "");

  const defaultTheme = `css/${baseName}.css`;
  const darkTheme = `css_dark/${baseName}_dark.css`;

  function getCookie(name) {
    const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
    return match ? match[2] : null;
  }

  function setCookie(name, value, days) {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/`;
  }

  // Appliquer le thème sauvegardé
  const savedTheme = getCookie("theme");
  const isDark = savedTheme === "dark";
  themeLink.href = isDark ? darkTheme : defaultTheme;

  // Synchroniser le toggle visuellement
  if (themeToggle) {
    themeToggle.checked = isDark;

    themeToggle.addEventListener("change", () => {
      const wantDark = themeToggle.checked;
      themeLink.href = wantDark ? darkTheme : defaultTheme;
      setCookie("theme", wantDark ? "dark" : "light", 30);
    });
  }
});
