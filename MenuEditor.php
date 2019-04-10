<?php

if (isset($_POST['menu'])) {
    $file = 'D:\xampp\htdocs\saharashishalounge.sk\new_menu.json'; //'C:\wamp64\www\SaharaWebsite\new_menu.json';
    file_put_contents($file, $_POST['menu']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sahara café Nitra - príjemné posedenie v exotickom prostredí</title>
    <meta name="description" content="Sahara café Nitra je jedinecný a štýlový podnik s nádychom Orientu, ktorý v Nitre chýbal. My sme pre Vás vytvorili miesto, kde si môžete príjemne posediet s priatelmi pri vodnej fajke. Neváhajte a navštívte nás! U nás si každý pôžitkár príde na svoje.">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="Sahara/sahara-icon.jpg">
    <link rel="stylesheet" href="StyleSheet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Sahara café</a>
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="index.html" class="nav-link">Doma</a>
            </li>
            <li class="nav-item">
                <a href="Menu.html" class="nav-link">Menu</a>
            </li>
            <li class="nav-item">
                <a href="WaterPipes.html" class="nav-link">Vodné fajky</a>
            </li>
            <li class="nav-item">
                <a href="https://www.google.com/maps/place/Sahara+Caf%C3%A9/@48.31018,18.087568,19z/data=!4m5!3m4!1s0x0:0xe7aa6a37430b2165!8m2!3d48.3100745!4d18.0875835?hl=en-US" target="_blank" class="nav-link">Kde nás najdete</a>
            </li>
            <li class="nav-item">
                <a href="Contact.html" class="nav-link">Kontakt</a>
            </li>
            <li class="nav-item">
                <a href="Gallery.html" class="nav-link">Galéria</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <button class="btn btn-primary mb-2" onclick="saveMenu();">Save</button>

        <div id="sections">
            <div class="section">
                <div class="section-content">
                    <div id="menu-item">
                        <label for="name"><b>Name</b></label>
                        <input type="text" name="name" class="form-control" placeholder="Name...">
                        <label for="name"><b>Price</b></label>
                        <input type="text" name="price" class="form-control" placeholder="2,20 €">
                        <label for="name"><b>Description</b></label>
                        <input type="text" name="description" class="form-control">
                    </div>

                    <!-- <button class="btn btn-primary">Add a Menu Item</button> -->
                </div>
            </div>
        </div>
    </div>

    <script>

    function saveMenu() {
        var sections = document.getElementsByClassName('section');
        var menuObject = { "content": [] };
         // Start at one to skip the first section used for copying
        for (var i = 1; i < sections.length; i++) {
           
           // i - 1 to prevent the first entry from being null.
            menuObject.content[i - 1] = {
                "category": sections[i].childNodes[0].childNodes[1].value,
                "description": sections[i].childNodes[1].childNodes[1].value,
                "items": []
            };
            
            var menuItems = sections[i].childNodes[2].children;
            for (var c = 0; c < menuItems.length; c++) {

                var menuItem = menuItems[c];

                menuObject.content[i - 1].items.push({
                    "name": menuItem.childNodes[3].value,
                    "price": menuItem.childNodes[7].value,
                    "description": menuItem.childNodes[11].value
                });
            }
        }
        
        $.post(window.location, {menu: JSON.stringify(menuObject, undefined, 2)}, function(result) {});
    }

    var requestURL = 'new_menu.json';
    var request = new XMLHttpRequest();
    request.open('GET', requestURL);
    request.responseType = 'json';
    request.send();
    request.onload = function () {
        var menu = request.response;
        
        var sections = document.getElementById("sections");
        for (var i = 0, classNumber = 0; i < menu.content.length; i++) {
            var itemSet = menu.content[i];

            // Add a section
            var section = document.createElement("div");
            section.className = "section";
            sections.appendChild(section);

            // Add a category
            var category = document.createElement("div");
            category.className = "section-category";
            category.innerHTML = '<label for="category"><b>Category</b></label><input type="text" name="category" class="form-control w-50 mb-4 category-input" placeholder="Category...">';
            category.childNodes[1].value = itemSet.category;
            section.appendChild(category);

            // Add a category
            var sectionDesc = document.createElement("div");
            sectionDesc.className = "section-desc";
            sectionDesc.innerHTML = '<label for="desc"><b>Description</b></label><input type="text" name="desc" class="form-control w-50 mb-4" placeholder="Description...">';
            sectionDesc.childNodes[1].value = itemSet.description;
            section.appendChild(sectionDesc);

            // Add content for menu items
            var content = document.createElement("div");
            content.className = "section-content";
            section.appendChild(content);

            for (var c = 0; c < menu.content[i].items.length; c++, classNumber++) {
                var item = menu.content[i].items[c];

                // Add a menu item
                var menuItem = document.createElement("div");
                menuItem.className = "menu-item menu-item-" + classNumber;
                menuItem.innerHTML = document.getElementById('menu-item').innerHTML;
                menuItem.id = '';
                content.appendChild(menuItem);

                $('.menu-item-' + classNumber).find('.form-control')[0].value = item.name;
                $('.menu-item-' + classNumber).find('.form-control')[1].value = '2,20';
                $('.menu-item-' + classNumber).find('.form-control')[2].value = item.description;
            }
        }
    }
    </script>
</body>
</html>