
function loadVaccinations() {
    const userId = document.getElementById("user_id").value;
    const apiKey = document.getElementById("api_key").value;

    fetch(`http://localhost/prs/api/get_vaccinations_protected.php`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ user_id: userId, key: apiKey })
    })
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById("vaccinationTable").getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";

        if (data.status === "success") {
            data.data.forEach(record => {
                const row = tableBody.insertRow();
                row.insertCell().innerText = record.record_id;
                row.insertCell().innerText = record.vaccine_type;
                row.insertCell().innerText = record.dose_number ?? "";
                row.insertCell().innerText = record.vaccination_date;
                row.insertCell().innerText = record.vaccination_center ?? "";
                row.insertCell().innerText = record.region ?? "";
                row.insertCell().innerText = record.location ?? "";
            });
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        alert("Request failed: " + error);
    });
}
