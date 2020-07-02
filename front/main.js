if (!sessionStorage.getItem("user") || !JSON.parse(sessionStorage.getItem("user")).iduser) {
    window.location.href = "./pages/login/index.html";
} else {
    window.location.href = "./pages/dashboard/index.html";
}