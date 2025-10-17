<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Collaborations</title>
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            margin: 24px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: end;
        }

        label {
            display: block;
            font-size: 12px;
            color: #555;
            margin-bottom: 4px;
        }

        input,
        select,
        button {
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        h1 {
            margin-top: 0;
        }

        .group {
            margin-top: 20px;
        }

        .muted {
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <h1>Company Collaborations</h1>

    <div class="card">
        <div class="row">
            <div>
                <label for="date">Filter by date</label>
                <input id="date" type="date" />
            </div>
            <div>
                <label for="company">Filter by company</label>
                <select id="company">
                    <option value="">All companies</option>
                </select>
            </div>
            <div>
                <button id="apply">Apply Filters</button>
                <button id="clear" type="button">Clear</button>
            </div>
        </div>
    </div>

    <div id="content"></div>

    <script>
        const content = document.getElementById('content');
        const dateInput = document.getElementById('date');
        const companySelect = document.getElementById('company');
        const applyBtn = document.getElementById('apply');
        const clearBtn = document.getElementById('clear');

        async function fetchJSON(url) {
            const res = await fetch(url);
            if (!res.ok) throw new Error('Request failed');
            return await res.json();
        }

        async function loadCompanies() {
            const companies = await fetchJSON('/api/companies');
            companies.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.name;
                companySelect.appendChild(opt);
            });
        }

        function renderGrouped(groups) {
            content.innerHTML = '';
            if (!groups.length) {
                content.innerHTML = '<p class="muted">No results.</p>';
                return;
            }
            groups.forEach(g => {
                const div = document.createElement('div');
                div.className = 'group card';
                div.innerHTML = `
          <h2>${g.city}</h2>
          <table>
            <thead>
              <tr><th>Company</th><th>Collaborator</th><th>Date</th><th>Status</th></tr>
            </thead>
            <tbody>
              ${g.records.map(r => `<tr>
                    <td>${r.company}</td>
                    <td>${r.collaborator}</td>
                    <td>${r.date}</td>
                    <td>${r.status}</td>
                  </tr>`).join('')}
            </tbody>
          </table>
        `;
                content.appendChild(div);
            });
        }

        function renderFlat(list) {
            content.innerHTML = '';
            if (!list.length) {
                content.innerHTML = '<p class="muted">No results.</p>';
                return;
            }
            const div = document.createElement('div');
            div.className = 'card';
            div.innerHTML = `
        <table>
          <thead>
            <tr><th>City</th><th>Company</th><th>Collaborator</th><th>Date</th><th>Status</th></tr>
          </thead>
          <tbody>
            ${list.map(r => `<tr>
                  <td>${r.city}</td>
                  <td>${r.company}</td>
                  <td>${r.collaborator}</td>
                  <td>${r.date}</td>
                  <td>${r.status}</td>
                </tr>`).join('')}
          </tbody>
        </table>
      `;
            content.appendChild(div);
        }

        async function load() {
            await loadCompanies();
            const data = await fetchJSON('/api/collaborations');
            renderGrouped(data);
        }

        applyBtn.addEventListener('click', async () => {
            const date = dateInput.value;
            const companyId = companySelect.value;

            if (date) {
                const data = await fetchJSON('/api/collaborations/by-date?date=' + date);
                renderFlat(data.data || data);
                return;
            }

            if (companyId) {
                const data = await fetchJSON('/api/collaborations/company/' + companyId);
                renderFlat(data.collaborations || []);
                return;
            }

            const data = await fetchJSON('/api/collaborations');
            renderGrouped(data);
        });

        clearBtn.addEventListener('click', async () => {
            dateInput.value = '';
            companySelect.value = '';
            const data = await fetchJSON('/api/collaborations');
            renderGrouped(data);
        });

        load().catch(err => {
            content.innerHTML = '<p class="muted">Failed to load data.</p>';
            console.error(err);
        });
    </script>
</body>

</html>
