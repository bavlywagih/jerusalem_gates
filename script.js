var addGateFormContainer = document.getElementById('addGateFormContainer');
fetch('add_gate_form.html')
    .then(response => response.text())
    .then(data => {
        addGateFormContainer.innerHTML = data;

        document.getElementById('addGateForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('add_gate.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var responseDiv = document.getElementById('response');
                if (data.status === 'success') {
                    responseDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
                    setTimeout(function() {
                        window.location.href = 'index.html';
                    }, 2000); // Wait for 2 seconds before redirecting
                } else {
                    responseDiv.innerHTML = `<p style="color: red;">${data.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    })
    .catch(error => {
        console.error('Error loading form:', error);
    });

document.getElementById('showAddGateForm').addEventListener('click', function() {
    if (addGateFormContainer.style.display === 'block') {
        addGateFormContainer.style.display = 'none';
    } else {
        addGateFormContainer.style.display = 'block';
    }
});

function fetchGates() {
    fetch('display_gates.php')
        .then(response => response.json())
        .then(data => {
            var gatesDiv = document.getElementById('gates');
            gatesDiv.innerHTML = '';
            if (data.status === 'success' && data.data.length > 0) {
                data.data.forEach(gate => {
                    var gateDiv = document.createElement('div');
                    gateDiv.className = 'gate';
                    gateDiv.innerHTML = `
                        <h2>${gate.name}</h2>
                        <p>${gate.description}</p>
                        <p><strong>Historical Significance:</strong> ${gate.historical_significance}</p>
                        ${gate.image_url ? `<img src="${gate.image_url}" alt="${gate.name}">` : ''}
                    `;
                    gatesDiv.appendChild(gateDiv);
                });
            } else {
                gatesDiv.innerHTML = '<p>No gates found.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Fetch gates on page load
fetchGates();
