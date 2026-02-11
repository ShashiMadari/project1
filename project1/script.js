function fetchData() {
    fetch("fetch_data.php")
        .then(res => res.json())
        .then(data => {
            document.getElementById("output").innerText =
                JSON.stringify(data, null, 2);
        });
}

function createHash() {
    const text = document.getElementById("hashInput").value;

    fetch("hash.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({text})
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("hashOutput").innerText = data.hash;
    });
}
