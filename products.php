
<?php
session_start();
include 'header.php'; // header.php also includes init.php


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Stationery & Books Shop</title>
</head>
<body>



<div class="content-wrapper">
    <h2>Shop Categories</h2>

    <div id="categories">
        <button class="category-btn" data-category="novels">Novels</button>
        <button class="category-btn" data-category="art_supplies">Art Supplies</button>
        <button class="category-btn" data-category="office_school">Office & School</button>
        <button class="category-btn" onclick="displayProducts()">Show All Products</button>
    </div>

    <div id="subcategories"></div>
    <main id="products-container"></main>
</div>

<script>
// Products array
const products = [
  // ================= ART SUPPLIES : DRAWING =================
  {id: 1, name: 'Charcoal Pencil Set - 12pcs (Soft)', category: 'art_supplies', sub: 'Drawing', price: 450, image: 'images/art_supplies/drawing/Charcoal_Pencil_Set_12pcs_Soft.jpeg'},
  {id: 2, name: 'Colour Pencils', category: 'art_supplies', sub: 'Drawing', price: 300, image: 'images/art_supplies/drawing/colour_pensils.jpeg'},
  {id: 3, name: 'Crayons', category: 'art_supplies', sub: 'Drawing', price: 250, image: 'images/art_supplies/drawing/crayons.jpeg'},
  {id: 4, name: 'Oil Pastels', category: 'art_supplies', sub: 'Drawing', price: 350, image: 'images/art_supplies/drawing/oil_pastels.jpeg'},
  {id: 5, name: 'Sketch Pens', category: 'art_supplies', sub: 'Drawing', price: 280, image: 'images/art_supplies/drawing/sketch_pens.jpeg'},

  // ================= ART SUPPLIES : PAINTING =================
  {id: 6, name: 'Acrylic Paint Set 24 Colours 36ml', category: 'art_supplies', sub: 'Painting', price: 1200, image: 'images/art_supplies/painting/Acrylic_Paint_Set_24_Colours_36ml.jpeg'},
  {id: 7, name: 'Marker Set', category: 'art_supplies', sub: 'Painting', price: 600, image: 'images/art_supplies/painting/marker_set.jpeg'},
  {id: 8, name: 'Paint Brushes', category: 'art_supplies', sub: 'Painting', price: 500, image: 'images/art_supplies/painting/paint_brushes.jpeg'},
  {id: 9, name: 'Water Colours', category: 'art_supplies', sub: 'Painting', price: 400, image: 'images/art_supplies/painting/water_colours.jpeg'},
  {id: 10, name: 'Wooden Palette', category: 'art_supplies', sub: 'Painting', price: 300, image: 'images/art_supplies/painting/Wooden_Palette.jpeg'},

  // ================= NOVELS : FANTASY =================
  {id: 11, name: 'Can We Be Strangers Again', category: 'novels', sub: 'Fantasy', price: 700, image: 'images/novels/fantasy/can_we_be_strangers_again.jpeg'},
  {id: 12, name: 'Everything I Never Told You', category: 'novels', sub: 'Fantasy', price: 750, image: 'images/novels/fantasy/everything_i_never_told_you.jpeg'},
  {id: 13, name: 'Meet Me in Another Life', category: 'novels', sub: 'Fantasy', price: 720, image: 'images/novels/fantasy/meet_me_in_another_life.jpeg'},
  {id: 14, name: 'Things I Wanted To Say', category: 'novels', sub: 'Fantasy', price: 680, image: 'images/novels/fantasy/things_i_wanted_to_say.jpeg'},
  {id: 15, name: 'You Have To Choose What You Wanna Believe', category: 'novels', sub: 'Fantasy', price: 700, image: 'images/novels/fantasy/you_have_to_choose.jpeg'},

  // ================= NOVELS : FICTION =================
  {id: 16, name: 'Never Lie', category: 'novels', sub: 'Fiction', price: 800, image: 'images/novels/fiction/Never_Lie.jpeg'},
  {id: 17, name: 'The Inmate', category: 'novels', sub: 'Fiction', price: 850, image: 'images/novels/fiction/The_Inmate.jpeg'},
  {id: 18, name: 'The Perfect Son', category: 'novels', sub: 'Fiction', price: 820, image: 'images/novels/fiction/The_Perfect_Son.jpeg'},
  {id: 19, name: 'The Silent Patient', category: 'novels', sub: 'Fiction', price: 900, image: 'images/novels/fiction/The_Silent_Patient.jpeg'},
  {id: 20, name: 'The Wife Upstairs', category: 'novels', sub: 'Fiction', price: 780, image: 'images/novels/fiction/The_Wife_Upstairs.jpeg'},

  // ================= NOVELS : MYSTERY =================
  {id: 21, name: 'Five Survive', category: 'novels', sub: 'Mystery', price: 750, image: 'images/novels/mystery/five_survive.jpeg'},
  {id: 22, name: 'One Of Us Is Lying', category: 'novels', sub: 'Mystery', price: 700, image: 'images/novels/mystery/one_of_us_is_lying.jpeg'},
  {id: 23, name: 'The Girls Who Disappeared', category: 'novels', sub: 'Mystery', price: 770, image: 'images/novels/mystery/The_girls_who_disappeared.jpeg'},
  {id: 24, name: 'The Perfect Marriage', category: 'novels', sub: 'Mystery', price: 820, image: 'images/novels/mystery/the_perfect_marriage.jpeg'},
  {id: 25, name: 'Then She Was Gone', category: 'novels', sub: 'Mystery', price: 790, image: 'images/novels/mystery/Then_She_Was_Gone.jpeg'},

  // ================= NOVELS : NONFICTION =================
  {id: 26, name: 'None of This Is True', category: 'novels', sub: 'Nonfiction', price: 760, image: 'images/novels/nonfiction/None_of_This_Is_True.jpeg'},
  {id: 27, name: 'Not Quite Dead Yet', category: 'novels', sub: 'Nonfiction', price: 780, image: 'images/novels/nonfiction/Not_Quite_Dead_Yet.jpeg'},
  {id: 28, name: 'Rock Paper Scissors', category: 'novels', sub: 'Nonfiction', price: 740, image: 'images/novels/nonfiction/Rock_Paper_Scissors.jpeg'},
  {id: 29, name: 'The Only One Left', category: 'novels', sub: 'Nonfiction', price: 800, image: 'images/novels/nonfiction/The_Only_One_Left.jpeg'},
  {id: 30, name: 'The Silent Patient', category: 'novels', sub: 'Nonfiction', price: 900, image: 'images/novels/nonfiction/The_Silent_Patient.jpeg'},

  // ================= NOVELS : ROMANCE =================
  {id: 31, name: 'Confess', category: 'novels', sub: 'Romance', price: 700, image: 'images/novels/romance/confess.jpeg'},
  {id: 32, name: 'It Starts With Us', category: 'novels', sub: 'Romance', price: 850, image: 'images/novels/romance/It_Starts_With_Us.jpeg'},
  {id: 33, name: 'November 9', category: 'novels', sub: 'Romance', price: 780, image: 'images/novels/romance/November_9.jpeg'},
  {id: 34, name: 'Twisted Love', category: 'novels', sub: 'Romance', price: 900, image: 'images/novels/romance/Twisted_Love.jpeg'},
  {id: 35, name: 'Ugly Love', category: 'novels', sub: 'Romance', price: 820, image: 'images/novels/romance/Ugly_Love.jpeg'},

  // ================= NOVELS : THRILLER =================
  {id: 36, name: 'Plot Twists I Didn’t See Coming', category: 'novels', sub: 'Thriller', price: 880, image: 'images/novels/thriller/Plot_Twists.jpeg'},
  {id: 37, name: 'The Co-Worker', category: 'novels', sub: 'Thriller', price: 790, image: 'images/novels/thriller/the_co_worker.jpeg'},
  {id: 38, name: 'The Gift', category: 'novels', sub: 'Thriller', price: 750, image: 'images/novels/thriller/The_Gift.jpeg'},
  {id: 39, name: 'The Housemaid', category: 'novels', sub: 'Thriller', price: 830, image: 'images/novels/thriller/The_Housemaid.jpeg'},
  {id: 40, name: 'The Tenant', category: 'novels', sub: 'Thriller', price: 800, image: 'images/novels/thriller/The_Tenant.jpeg'},

  // ================= OFFICE & SCHOOL : BOOKS & PAPER =================
  {id: 41, name: 'Coloured Manilla Paper', category: 'office_school', sub: 'Books & Paper', price: 150, image: 'images/office_school_supplies/books_paper/coloured_manilla_paper.jpeg'},
  {id: 42, name: 'Envelopes', category: 'office_school', sub: 'Books & Paper', price: 100, image: 'images/office_school_supplies/books_paper/Envelopes.jpeg'},
  {id: 43, name: 'Pattern Cutting Manilla Paper', category: 'office_school', sub: 'Books & Paper', price: 180, image: 'images/office_school_supplies/books_paper/pattern_cutting_manilla.jpeg'},
  {id: 44, name: 'JK Copier A4 Paper', category: 'office_school', sub: 'Books & Paper', price: 500, image: 'images/office_school_supplies/books_paper/JK_Copier_Paper.jpeg'},
  {id: 45, name: 'Notebook', category: 'office_school', sub: 'Books & Paper', price: 120, image: 'images/office_school_supplies/books_paper/notebook.jpeg'},
  {id: 46, name: 'Sketchbook', category: 'office_school', sub: 'Books & Paper', price: 200, image: 'images/office_school_supplies/books_paper/Sketchbook.jpeg'},
  {id: 47, name: 'Surard Notebook', category: 'office_school', sub: 'Books & Paper', price: 140, image: 'images/office_school_supplies/books_paper/Surard_notebook.jpeg'},
  {id: 48, name: 'Uni Foolscap Paper', category: 'office_school', sub: 'Books & Paper', price: 180, image: 'images/office_school_supplies/books_paper/Uni_Foolscap_Paper.jpeg'},

  // ================= OFFICE & SCHOOL : MEASURING & DESK =================
  {id: 49, name: 'Desk Organizer Tray', category: 'office_school', sub: 'Measuring & Desk', price: 600, image: 'images/office_school_supplies/measuringtools_deskitems/Desk_Organizer.jpeg'},
  {id: 50, name: 'Scientific Calculator', category: 'office_school', sub: 'Measuring & Desk', price: 1500, image: 'images/office_school_supplies/measuringtools_deskitems/Calculator.jpeg'},
  {id: 51, name: 'Flexible Ruler', category: 'office_school', sub: 'Measuring & Desk', price: 80, image: 'images/office_school_supplies/measuringtools_deskitems/Flexible_Ruler.jpeg'},
  {id: 52, name: 'Glue Stick', category: 'office_school', sub: 'Measuring & Desk', price: 90, image: 'images/office_school_supplies/measuringtools_deskitems/Glue_Stick.jpeg'},
  {id: 53, name: 'Mathematical Set', category: 'office_school', sub: 'Measuring & Desk', price: 250, image: 'images/office_school_supplies/measuringtools_deskitems/Mathematical_set.jpeg'},
  {id: 54, name: 'Paper Binder Clips', category: 'office_school', sub: 'Measuring & Desk', price: 180, image: 'images/office_school_supplies/measuringtools_deskitems/Binder_Clips.jpeg'},
  {id: 55, name: 'Paper Punch', category: 'office_school', sub: 'Measuring & Desk', price: 300, image: 'images/office_school_supplies/measuringtools_deskitems/Paper_Punch.jpeg'},
  {id: 56, name: 'Rubber Eraser', category: 'office_school', sub: 'Measuring & Desk', price: 50, image: 'images/office_school_supplies/measuringtools_deskitems/Rubber.jpeg'},
  {id: 57, name: 'Scissors', category: 'office_school', sub: 'Measuring & Desk', price: 180, image: 'images/office_school_supplies/measuringtools_deskitems/Scissors.jpeg'},
  {id: 58, name: 'Sharpener', category: 'office_school', sub: 'Measuring & Desk', price: 40, image: 'images/office_school_supplies/measuringtools_deskitems/Sharpener.jpeg'},
  {id: 59, name: 'Stapler', category: 'office_school', sub: 'Measuring & Desk', price: 200, image: 'images/office_school_supplies/measuringtools_deskitems/Stapler.jpeg'},

  // ================= OFFICE & SCHOOL : WRITING =================
  {id: 60, name: '12 Set Pencils', category: 'office_school', sub: 'Writing', price: 120, image: 'images/office_school_supplies/writing/12_set_pencils.jpeg'},
  {id: 61, name: 'Blue Bic Pen', category: 'office_school', sub: 'Writing', price: 50, image: 'images/office_school_supplies/writing/Blue_bic_pen.jpeg'},
  {id: 62, name: 'Black Bic Pen', category: 'office_school', sub: 'Writing', price: 50, image: 'images/office_school_supplies/writing/Black_bic_pen.jpeg'},
  {id: 63, name: 'Correction Fluid', category: 'office_school', sub: 'Writing', price: 120, image: 'images/office_school_supplies/writing/Correction_Fluid.jpeg'},
  {id: 64, name: 'Fountain Pens', category: 'office_school', sub: 'Writing', price: 350, image: 'images/office_school_supplies/writing/Fountain_Pens.jpeg'},
  {id: 65, name: 'Highlighter', category: 'office_school', sub: 'Writing', price: 90, image: 'images/office_school_supplies/writing/highlighter.jpeg'},
  {id: 66, name: 'Red Pen', category: 'office_school', sub: 'Writing', price: 50, image: 'images/office_school_supplies/writing/Red_pen.jpeg'}
];

// DOM Elements
const productsContainer = document.getElementById("products-container");
const subcategoriesDiv = document.getElementById("subcategories");
const cartCountEl = document.getElementById("cart-count");

// Display products (optionally filtered)
function displayProducts(filtered=null){
    container=productsContainer; // Use the globally defined productsContainer
    container.innerHTML='';
    const list=filtered || products;
    if(list.length === 0) {
        container.innerHTML = "<p style='font-size:18px; text-align:center;'>No products found.</p>";
        return;
    }
    list.forEach(p=>{
        const div=document.createElement('div');
        div.className='product';
        div.innerHTML=`
            <img src="${p.image}" alt="${p.name}" class="product-img">
            <h3>${p.name}</h3>
            <p>Ksh ${p.price}</p>
            <button class="add-btn" onclick="addToCart(${p.id})">Add to Cart</button>
        `;
        container.appendChild(div);
    });
}

// Show Category
function showCategory(categoryName) {
  const filtered = products.filter(p => p.category === categoryName);
  displayProducts(filtered);

  // Create subcategory buttons
  const subs = [...new Set(filtered.map(p => p.sub))];
  subcategoriesDiv.innerHTML = "";
  subs.forEach(sub => {
    const btn = document.createElement("button");
    btn.className = "sub-btn";
    btn.innerText = sub;
    btn.onclick = () => showSubcategory(categoryName, sub);
    subcategoriesDiv.appendChild(btn);
  });
}

// Show Subcategory
function showSubcategory(categoryName, subName) {
  const filtered = products.filter(p => p.category === categoryName && p.sub === subName);
  displayProducts(filtered);
}

// Add to Cart
function addToCart(productId){
    fetch("http://localhost:8000/cart/add_to_cart.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`product_id=${encodeURIComponent(productId)}`
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            alert(`${data.message}`);
            updateCartCount();
        }else{
            alert(data.message);
        }
    })
    .catch(err=>{
        console.error("Backend error:",err);
        alert("Failed to connect to backend at " + "http://localhost:8000/cart/add_to_cart.php" + ". Make sure PHP server is running and the URL is correct.");
    });
}

// Update cart count
function updateCartCount(){
    fetch("http://localhost:8000/cart/cart_fetch.php")
        .then(res=>res.json())
        .then(cart=>{
            if(cartCountEl) cartCountEl.textContent=cart.length||0;
        });
}

// Initialize
displayProducts();
updateCartCount();

// Attach category buttons
document.querySelectorAll(".category-btn").forEach(btn => {
  const cat = btn.getAttribute("data-category");
  if(cat) btn.onclick = () => showCategory(cat);
});
</script>

</body>
</html>



