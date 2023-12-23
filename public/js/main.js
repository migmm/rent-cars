async function getCities() {
    var countrySelect = document.getElementById("countrySelect");
    var citySelect = document.getElementById("citySelect");

    var selectedCountry = countrySelect.value;

    try {
        var response = await fetch(`utils/getCities.php?country_id=${selectedCountry}`);
        var cities = await response.json();

        citySelect.innerHTML = "";
        for (var i = 0; i < cities.length; i++) {
            var option = document.createElement("option");
            option.value = cities[i].id;
            option.text = cities[i].name;
            citySelect.add(option);
        }
    } catch (error) {
        console.error("Error al obtener ciudades:", error);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    getCities();
});