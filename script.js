// ===== INITIALIZE CART =====
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// ===== PRODUCTS DATA =====
const products = [
  // ================= ART SUPPLIES : DRAWING =================
  { id: "1", title: "Charcoal Pencil Set - 12pcs (Soft)", price: 450, category: "art_supplies", sub: "Drawing", image: "images/art_supplies/drawing/Charcoal_Pencil_Set_12pcs_Soft.jpeg", description: "Soft charcoal pencil set" },
  { id: "2", title: "Colour Pencils", price: 300, category: "art_supplies", sub: "Drawing", image: "images/art_supplies/drawing/colour_pensils.jpeg", description: "Bright colored pencils for drawing" },
  { id: "3", title: "Crayons", price: 250, category: "art_supplies", sub: "Drawing", image: "images/art_supplies/drawing/crayons.jpeg", description: "Set of wax crayons" },
  { id: "4", title: "Oil Pastels", price: 350, category: "art_supplies", sub: "Drawing", image: "images/art_supplies/drawing/oil_pastels.jpeg", description: "Soft oil pastels" },
  { id: "5", title: "Sketch Pens", price: 280, category: "art_supplies", sub: "Drawing", image: "images/art_supplies/drawing/sketch_pens.jpeg", description: "Set of colorful sketch pens" },

  // ================= ART SUPPLIES : PAINTING =================
  { id: "6", title: "Acrylic Paint Set 24 Colours 36ml", price: 1200, category: "art_supplies", sub: "Painting", image: "images/art_supplies/painting/Acrylic_Paint_Set_24_Colours_36ml.jpeg", description: "24-color acrylic paint set" },
  { id: "7", title: "Marker Set", price: 600, category: "art_supplies", sub: "Painting", image: "images/art_supplies/painting/marker_set.jpeg", description: "Set of markers for painting" },
  { id: "8", title: "Paint Brushes", price: 500, category: "art_supplies", sub: "Painting", image: "images/art_supplies/painting/paint_brushes.jpeg", description: "Set of various paint brushes" },
  { id: "9", title: "Water Colours", price: 400, category: "art_supplies", sub: "Painting", image: "images/art_supplies/painting/water_colours.jpeg", description: "Watercolour set for painting" },
  { id: "10", title: "Wooden Palette", price: 300, category: "art_supplies", sub: "Painting", image: "images/art_supplies/painting/Wooden_Palette.jpeg", description: "Wooden palette for mixing paints" },

  // ================= NOVELS : FANTASY =================
  { id: "11", title: "Can We Be Strangers Again", price: 700, category: "novels", sub: "Fantasy", image: "images/novels/fantasy/can_we_be_strangers_again.jpeg", description: "Fantasy novel" },
  { id: "12", title: "Everything I Never Told You", price: 750, category: "novels", sub: "Fantasy", image: "images/novels/fantasy/everything_i_never_told_you.jpeg", description: "Fantasy novel" },
  { id: "13", title: "Meet Me in Another Life", price: 720, category: "novels", sub: "Fantasy", image: "images/novels/fantasy/meet_me_in_another_life.jpeg", description: "Fantasy novel" },
  { id: "14", title: "Things I Wanted To Say", price: 680, category: "novels", sub: "Fantasy", image: "images/novels/fantasy/things_i_wanted_to_say.jpeg", description: "Fantasy novel" },
  { id: "15", title: "You Have To Choose What You Wanna Believe", price: 700, category: "novels", sub: "Fantasy", image: "images/novels/fantasy/you_have_to_choose.jpeg", description: "Fantasy novel" },

  // ================= NOVELS : FICTION =================
  { id: "16", title: "Never Lie", price: 800, category: "novels", sub: "Fiction", image: "images/novels/fiction/Never_Lie.jpeg", description: "Fiction novel" },
  { id: "17", title: "The Inmate", price: 850, category: "novels", sub: "Fiction", image: "images/novels/fiction/The_Inmate.jpeg", description: "Fiction novel" },
  { id: "18", title: "The Perfect Son", price: 820, category: "novels", sub: "Fiction", image: "images/novels/fiction/The_Perfect_Son.jpeg", description: "Fiction novel" },
  { id: "19", title: "The Silent Patient", price: 900, category: "novels", sub: "Fiction", image: "images/novels/fiction/The_Silent_Patient.jpeg", description: "Fiction novel" },
  { id: "20", title: "The Wife Upstairs", price: 780, category: "novels", sub: "Fiction", image: "images/novels/fiction/The_Wife_Upstairs.jpeg", description: "Fiction novel" },

  // ================= NOVELS : MYSTERY =================
  { id: "21", title: "Five Survive", price: 750, category: "novels", sub: "Mystery", image: "images/novels/mystery/five_survive.jpeg", description: "Mystery novel" },
  { id: "22", title: "One Of Us Is Lying", price: 700, category: "novels", sub: "Mystery", image: "images/novels/mystery/one_of_us_is_lying.jpeg", description: "Mystery novel" },
  { id: "23", title: "The Girls Who Disappeared", price: 770, category: "novels", sub: "Mystery", image: "images/novels/mystery/The_girls_who_disappeared.jpeg", description: "Mystery novel" },
  { id: "24", title: "The Perfect Marriage", price: 820, category: "novels", sub: "Mystery", image: "images/novels/mystery/the_perfect_marriage.jpeg", description: "Mystery novel" },
  { id: "25", title: "Then She Was Gone", price: 790, category: "novels", sub: "Mystery", image: "images/novels/mystery/Then_She_Was_Gone.jpeg", description: "Mystery novel" },

  // ================= NOVELS : NONFICTION =================
  { id: "26", title: "None of This Is True", price: 760, category: "novels", sub: "Nonfiction", image: "images/novels/nonfiction/None_of_This_Is_True.jpeg", description: "Nonfiction novel" },
  { id: "27", title: "Not Quite Dead Yet", price: 780, category: "novels", sub: "Nonfiction", image: "images/novels/nonfiction/Not_Quite_Dead_Yet.jpeg", description: "Nonfiction novel" },
  { id: "28", title: "Rock Paper Scissors", price: 740, category: "novels", sub: "Nonfiction", image: "images/novels/nonfiction/Rock_Paper_Scissors.jpeg", description: "Nonfiction novel" },
  { id: "29", title: "The Only One Left", price: 800, category: "novels", sub: "Nonfiction", image: "images/novels/nonfiction/The_Only_One_Left.jpeg", description: "Nonfiction novel" },
  { id: "30", title: "The Silent Patient", price: 900, category: "novels", sub: "Nonfiction", image: "images/novels/nonfiction/The_Silent_Patient.jpeg", description: "Nonfiction novel" },

  // ================= NOVELS : ROMANCE =================
  { id: "31", title: "Confess", price: 700, category: "novels", sub: "Romance", image: "images/novels/romance/confess.jpeg", description: "Romance novel" },
  { id: "32", title: "It Starts With Us", price: 850, category: "novels", sub: "Romance", image: "images/novels/romance/It_Starts_With_Us.jpeg", description: "Romance novel" },
  { id: "33", title: "November 9", price: 780, category: "novels", sub: "Romance", image: "images/novels/romance/November_9.jpeg", description: "Romance novel" },
  { id: "34", title: "Twisted Love", price: 900, category: "novels", sub: "Romance", image: "images/novels/romance/Twisted_Love.jpeg", description: "Romance novel" },
  { id: "35", title: "Ugly Love", price: 820, category: "novels", sub: "Romance", image: "images/novels/romance/Ugly_Love.jpeg", description: "Romance novel" },

  // ================= NOVELS : THRILLER =================
  { id: "36", title: "Plot Twists I Didn’t See Coming", price: 880, category: "novels", sub: "Thriller", image: "images/novels/thriller/Plot_Twists.jpeg", description: "Thriller novel" },
  { id: "37", title: "The Co-Worker", price: 790, category: "novels", sub: "Thriller", image: "images/novels/thriller/the_co_worker.jpeg", description: "Thriller novel" },
  { id: "38", title: "The Gift", price: 750, category: "novels", sub: "Thriller", image: "images/novels/thriller/The_Gift.jpeg", description: "Thriller novel" },
  { id: "39", title: "The Housemaid", price: 830, category: "novels", sub: "Thriller", image: "images/novels/thriller/The_Housemaid.jpeg", description: "Thriller novel" },
  { id: "40", title: "The Tenant", price: 800, category: "novels", sub: "Thriller", image: "images/novels/thriller/The_Tenant.jpeg", description: "Thriller novel" },

  // ================= OFFICE & SCHOOL : BOOKS & PAPER =================
  { id: "41", title: "Coloured Manilla Paper", price: 150, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/coloured_manilla_paper.jpeg", description: "Colored manilla paper" },
  { id: "42", title: "Envelopes", price: 100, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/Envelopes.jpeg", description: "Pack of envelopes" },
  { id: "43", title: "Pattern Cutting Manilla Paper", price: 180, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/pattern_cutting_manilla.jpeg", description: "Manilla paper for patterns" },
  { id: "44", title: "JK Copier A4 Paper", price: 500, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/JK_Copier_Paper.jpeg", description: "A4 copier paper" },
  { id: "45", title: "Notebook", price: 120, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/notebook.jpeg", description: "Notebook" },
  { id: "46", title: "Sketchbook", price: 200, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/Sketchbook.jpeg", description: "Sketchbook" },
  { id: "47", title: "Surard Notebook", price: 140, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/Surard_notebook.jpeg", description: "Surard Notebook" },
  { id: "48", title: "Uni Foolscap Paper", price: 180, category: "office_school", sub: "Books & Paper", image: "images/office_school_supplies/books_paper/Uni_Foolscap_Paper.jpeg", description: "Foolscap paper" },

  // ================= OFFICE & SCHOOL : MEASURING & DESK =================
  { id: "49", title: "Desk Organizer Tray", price: 600, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Desk_Organizer.jpeg", description: "Desk organizer tray" },
  { id: "50", title: "Scientific Calculator", price: 1500, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Calculator.jpeg", description: "Scientific calculator" },
  { id: "51", title: "Flexible Ruler", price: 80, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Flexible_Ruler.jpeg", description: "Flexible ruler" },
  { id: "52", title: "Glue Stick", price: 90, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Glue_Stick.jpeg", description: "Glue stick" },
  { id: "53", title: "Mathematical Set", price: 250, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Mathematical_set.jpeg", description: "Mathematical set" },
  { id: "54", title: "Paper Binder Clips", price: 180, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Binder_Clips.jpeg", description: "Paper binder clips" },
  { id: "55", title: "Paper Punch", price: 300, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Paper_Punch.jpeg", description: "Paper punch" },
  { id: "56", title: "Rubber Eraser", price: 50, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Rubber.jpeg", description: "Rubber eraser" },
  { id: "57", title: "Scissors", price: 180, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Scissors.jpeg", description: "Scissors" },
  { id: "58", title: "Sharpener", price: 40, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Sharpener.jpeg", description: "Sharpener" },
  { id: "59", title: "Stapler", price: 200, category: "office_school", sub: "Measuring & Desk", image: "images/office_school_supplies/measuringtools_deskitems/Stapler.jpeg", description: "Stapler" },

  // ================= OFFICE & SCHOOL : WRITING =================
  { id: "60", title: "12 Set Pencils", price: 120, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/12_set_pencils.jpeg", description: "Set of 12 pencils" },
  { id: "61", title: "Blue Bic Pen", price: 50, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/Blue_bic_pen.jpeg", description: "Blue pen" },
  { id: "62", title: "Black Bic Pen", price: 50, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/Black_bic_pen.jpeg", description: "Black pen" },
  { id: "63", title: "Correction Fluid", price: 120, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/Correction_Fluid.jpeg", description: "Correction fluid" },
  { id: "64", title: "Fountain Pens", price: 350, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/Fountain_Pens.jpeg", description: "Fountain pens" },
  { id: "65", title: "Highlighter", price: 90, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/highlighter.jpeg", description: "Highlighter" },
  { id: "66", title: "Red Pen", price: 50, category: "office_school", sub: "Writing", image: "images/office_school_supplies/writing/Red_pen.jpeg", description: "Red pen" }
];


// ===== DOM ELEMENTS =====
const productsContainer = document.getElementById("products-container");
const subcategoriesDiv = document.getElementById("subcategories");
const cartCountEl = document.getElementById("cart-count");

// ===== DISPLAY PRODUCTS =====
function displayProducts(list) {
  productsContainer.innerHTML = "";
  if(list.length === 0) {
    productsContainer.innerHTML = "<p style='font-size:18px; text-align:center;'>No products found.</p>";
    return;
  }
  list.forEach(p => {
    const productEl = document.createElement("div");
    productEl.className = "product";
    productEl.innerHTML = `
      <img src="${p.image}" class="product-img" alt="${p.title}">
      <h4>${p.title}</h4>
      <p>Ksh ${p.price}</p>
      <button class="add-btn">Add to Cart</button>
    `;
    productsContainer.appendChild(productEl);

    // Add to cart button event
    const addBtn = productEl.querySelector(".add-btn");
    addBtn.addEventListener("click", () => addToCart(p.id));
  });
}

// ===== SHOW CATEGORY =====
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

// ===== SHOW SUBCATEGORY =====
function showSubcategory(categoryName, subName) {
  const filtered = products.filter(p => p.category === categoryName && p.sub === subName);
  displayProducts(filtered);
}

// ===== SHOW ALL PRODUCTS =====
function showAllProducts() {
  displayProducts(products);
  subcategoriesDiv.innerHTML = "";
}

// ===== ADD TO CART =====
function addToCart(id) {
  const product = products.find(p => p.id === id);
  const existing = cart.find(item => item.id === id);

  if(existing) {
    existing.quantity++;
  } else {
    cart.push({...product, quantity: 1});
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();
  alert(`${product.title} added to cart ✅`);
}

// ===== CART COUNT =====
function updateCartCount() {
  const count = cart.reduce((sum, item) => sum + item.quantity, 0);
  if(cartCountEl) cartCountEl.innerText = count;
}

// ===== PROFILE BUTTON VISIBILITY =====
function checkLogin() {
  const user = JSON.parse(localStorage.getItem("user")); // user object after login
  const loginNav = document.querySelector("nav a[href='login.html']");
  const profileNav = document.querySelector("nav a[href='profile.html']");

  if(user) {
    if(loginNav) loginNav.style.display = "none";
    if(profileNav) profileNav.style.display = "inline-block";
  } else {
    if(loginNav) loginNav.style.display = "inline-block";
    if(profileNav) profileNav.style.display = "none";
  }
}

// ===== ATTACH CATEGORY BUTTONS =====
document.querySelectorAll(".category-btn").forEach(btn => {
  const cat = btn.getAttribute("data-category");
  if(cat) btn.onclick = () => showCategory(cat);
});

// ===== INITIAL DISPLAY =====
displayProducts(products);
updateCartCount();
checkLogin();

