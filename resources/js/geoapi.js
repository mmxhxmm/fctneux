document.addEventListener('DOMContentLoaded', function () {
    // TODO: This might be interfering in add empresa 1 and 2, separate the variables so they dont interfere
    const key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
    const comunidadSelect = document.getElementById("comunidad");
    const provinciaSelect = document.getElementById("provincia");
    const municipioSelect = document.getElementById("municipio");

    async function cargarComunidades() {
        const res = await fetch(`https://apiv1.geoapi.es/comunidades?type=JSON&key=${key}`);
        const data = await res.json();

        const initialComunidad = comunidadSelect.dataset.initialValue;

        comunidadSelect.innerHTML = `<option value="">Selecciona una comunidad</option>`;
        data.data.forEach(c => {
            const option = document.createElement("option");
            option.value = c.CCOM;
            option.text = c.COM;
            if (initialComunidad && c.CCOM === initialComunidad) {
                option.selected = true;
            }
            comunidadSelect.appendChild(option);
        });

        if (initialComunidad) {
            await cargarProvincias(initialComunidad);
        }
    }

    async function cargarProvincias(ccom) {
        const res = await fetch(`https://apiv1.geoapi.es/provincias?CCOM=${ccom}&type=JSON&key=${key}`);
        const data = await res.json();

        const initialProvincia = provinciaSelect.dataset.initialValue;

        municipioSelect.innerHTML = `<option value="">Selecciona un municipio</option>`;
        data.data.forEach(p => {
            const option = document.createElement("option");
            option.value = p.CPRO;
            option.text = p.PRO;
            if (initialProvincia && p.CPRO === initialProvincia) {
                option.selected = true;
            }
            provinciaSelect.appendChild(option);
        });

        if (initialProvincia) {
            await cargarMunicipios(initialProvincia);
        }
    }


    async function cargarMunicipios(cpro) {
        const res = await fetch(`https://apiv1.geoapi.es/municipios?CPRO=${cpro}&type=JSON&key=${key}`);
        const data = await res.json();

        const initialMunicipio = municipioSelect.dataset.initialValue;

        municipioSelect.innerHTML = `<option value="">Selecciona un municipio</option>`;
        data.data.forEach(m => {
            const option = document.createElement("option");
            option.value = m.DMUN50;
            option.text = m.DMUN50;
            if (initialMunicipio && m.DMUN50 === initialMunicipio) {
                option.selected = true;
            }
            municipioSelect.appendChild(option);
        });
    }

    // Event Listeners
    comunidadSelect.addEventListener("change", e => {
        const ccom = e.target.value;
        if (ccom) cargarProvincias(ccom);
    });

    provinciaSelect.addEventListener("change", e => {
        const cpro = e.target.value;
        if (cpro) cargarMunicipios(cpro);
    });

    // Initial load
    cargarComunidades();
});