var AJAX = {
    post: function (url, params, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        var data = new FormData();
        for (var i in params) data.append(i, params[i]);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;
            if (xhr.status === 200) callback(xhr.responseText);
        };
        xhr.send(data);
    },
    get: function (url, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;
            if (xhr.status === 200) callback(xhr.responseText);
        };
        xhr.send();
    }
};

var page = {
    init: function () {
        this.countryWindow.init();
        this.cityWindow.init();
        this.form.init();
    }
};
page.form = {
    init: function () {
        this.container = document.querySelector(".form");

        this.countrySelect = this.container.querySelector(".country");
        this.contryAddBtn = this.container.querySelector(".addCountry");

        this.citySelect = this.container.querySelector(".city");
        this.cityAddBtn = this.container.querySelector(".addCity");

        this.addBtn = this.container.querySelector(".add");
        this.placeInput = this.container.querySelector(".place");

        this.bindEvents();
        this.loadCountries();
    },
    bindEvents: function () {
        this.contryAddBtn.addEventListener("click", this.onCountryAddBtn.bind(this));
        this.cityAddBtn.addEventListener("click", this.onCityAddBtn.bind(this));
        this.countrySelect.addEventListener("change",this.loadCities.bind(this));
        this.addBtn.addEventListener("click",this.addPlace.bind(this));
    },
    onCountryAddBtn: function () {
        page.countryWindow.show();
    },
    onCityAddBtn:function(){
        page.cityWindow.show();
    },
    loadCountries: function () {
        AJAX.get("/05_AJAX/getcountries",this.onCountriesLoaded.bind(this))
    },
    loadCities:function(){
        this.citySelect.innerHTML="";
        if(this.countrySelect.disabled) return;
        var country_id = this.countrySelect.value;
        //TODO ajax_request load cities
        AJAX.post("/05_AJAX/getcities",{country_id:country_id},this.onLoadCities.bind(this));
    },
    onLoadCities:function(data){
        var cities = JSON.parse(data);
        cities.forEach(function (c) {
            var option = document.createElement("option");
            option.setAttribute("value",c.id);
            option.innerText=c.name;
            this.citySelect.appendChild(option);
        }.bind(this));


        if(cities.length>0){
            this.citySelect.disabled=false;
            this.placeInput.disabled=false;
            this.addBtn.disabled=false;
        }else{
            this.citySelect.disabled=true;
            this.placeInput.disabled=true;
            this.addBtn.disabled=true;
        }

    },
    onCountriesLoaded:function (data) {
        var countries = JSON.parse(data);

        this.countrySelect.innerHTML="";
        countries.forEach(function (c) {
            var option = document.createElement("option");
            option.setAttribute("value",c.id);
            option.innerText=c.name;
            this.countrySelect.appendChild(option);
        }.bind(this));

        if(countries.length>0){
            this.countrySelect.disabled=false;
            this.cityAddBtn.disabled=false;
            //TODO load city
            this.loadCities();
        }else{
            this.countrySelect.disabled=true;
            this.cityAddBtn.disabled=true;
            this.placeInput.disabled=true;
            this.addBtn.disabled=true;
        }
    },
    getCountryId:function () {
        return this.countrySelect.disabled ? -1 : this.countrySelect.value;
    },
    addPlace:function () {
        var name = this.placeInput.value;
        var cid = this.citySelect.value;
        //TODO send place
        AJAX.post("/05_AJAX/addplace",{name:name,city_id:cid},function (response) {
            alert(response);
        })
    }
};

page.countryWindow = {
    init: function () {
        this.conteiner = document.querySelector(".country-window");
        this.fade = document.querySelector(".fade");
        this.inputElem = this.conteiner.querySelector("input");
        this.button = this.conteiner.querySelector("button");
        this.bindEvents()
    },
    bindEvents: function () {
        this.button.addEventListener("click", this.onBtnClick.bind(this));
    },
    onBtnClick: function () {
        var value = this.inputElem.value;
        //TODO: send AJAX
        AJAX.post("/05_AJAX/addcountry", {name: value}, this.onAdded.bind(this))
    },
    onAdded: function (response) {
        if(response=="yes"){
            page.form.loadCountries();
            this.hide();
        }else {
            alert("error");
            this.hide();
        }

    },
    show: function () {
        this.fade.style.display = "block";
        this.conteiner.style.display = "block";
    },
    hide: function () {
        this.fade.style.display = "none";
        this.conteiner.style.display = "none";
    }

};

page.cityWindow = {
    init: function () {
        this.conteiner = document.querySelector(".city-window");
        this.fade = document.querySelector(".fade");
        this.inputElem = this.conteiner.querySelector("input");
        this.button = this.conteiner.querySelector("button");
        this.bindEvents();
    },
    bindEvents: function () {
        this.button.addEventListener("click", this.onBtnClick.bind(this));
    },
    onBtnClick: function () {
        var value = this.inputElem.value;
        var cid = page.form.getCountryId();
        if(cid<0) {
            alert("!!!!!!!");
            return;
        }
        //TODO: send AJAX
        AJAX.post("/05_AJAX/addcity",{name:value,country_id:cid},this.onAdded.bind(this))
    },
    onAdded: function (response) {
        if(response=="yes"){
            page.form.loadCities();
            this.hide();
        }else {
            alert("error");
            this.hide();
        }

    },
    show: function () {
        this.fade.style.display = "block";
        this.conteiner.style.display = "block";
    },
    hide: function () {
        this.fade.style.display = "none";
        this.conteiner.style.display = "none";
    }

};


window.addEventListener("load", page.init.bind(page));


