function menuProfile() {
const profile = document.getElementById('profile');
    const profileStyle = profile.style.display;
    if (profile.style.display === "none") {
        profile.style.display = "block";
    } else {
        profile.style.display = "none";
    }
}