function onchangePref() {
    const inputValue = document.getElementById("pref").value;
    const params = { prefName: inputValue };
    const query_params = new URLSearchParams(params);
    fetch('/api/cities?' + query_params)
        .then((res) => {
            if (!res.ok) {
                throw new Error(`${res.status} ${res.statusText}`);
            }
            res.json().then(function(json) {
                const municipalities = json;
                const select = document.getElementById("municipalities");
                const unselected = select.options[0];
                select.innerHTML = "";
                select.appendChild(unselected);
                for (var i = 0; i < municipalities.length; i++) {
                    const mun = municipalities[i];
                    const el = document.createElement("option");
                    el.textContent = mun;
                    el.value = mun;
                    select.appendChild(el);
                }
            });
        });


}