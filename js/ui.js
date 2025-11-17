/**
 * UI Module
 * 
 * LES 1: TEMPLATE LITERALS
 * LES 1: ARROW FUNCTIONS
 * LES 1: DESTRUCTURING
 */

// LES 1: ARROW FUNCTION
// Maak HTML voor een meme card - Studio Museum horizontal strip style
const createMemeCard = (meme, index) => {
    // LES 1: DESTRUCTURING
    const { id, title, imageUrl, year, category, description } = meme;
    
    // Different heights for variety - like the museum
    const heights = ['h-96', 'h-[28rem]', 'h-80', 'h-[32rem]', 'h-96', 'h-[30rem]'];
    const height = heights[index % heights.length];
    
    // LES 1: TEMPLATE LITERAL - horizontal card for strip layout
    return `
        <article class="card-animate opacity-0 cursor-pointer group flex-shrink-0 w-80" data-id="${id}">
            <div class="bg-zinc-900 mb-3 ${height} overflow-hidden relative">
                <img 
                    src="${imageUrl}" 
                    alt="${title}" 
                    class="w-full h-full object-cover transition-all duration-500 ease-out group-hover:scale-110 group-hover:brightness-75"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
            </div>
            <h2 class="text-base font-medium mb-1 transition-all duration-300 group-hover:translate-x-1">${title}, ${year}</h2>
            <p class="text-sm text-gray-500 transition-all duration-300 group-hover:text-gray-300">${category}</p>
        </article>
    `;
};

// Render memes naar de DOM
export const renderMemes = (memes) => {
    // LES 1: CONST
    const grid = document.getElementById('meme-grid');
    
    if (memes.length === 0) {
        showNoResults();
        grid.innerHTML = '';
        return;
    }
    
    hideNoResults();
    
    // Limit to 6 memes
    const memesToShow = memes.slice(0, 6);
    
    // LES 1: TEMPLATE LITERAL - .map() maakt HTML voor elke meme
    const memesHTML = memesToShow.map((meme, index) => createMemeCard(meme, index)).join('');
    
    grid.innerHTML = memesHTML;
    
    updateResultsCount(memesToShow.length);
};

// Vul filter dropdowns
export const populateFilters = (years, categories) => {
    const yearFilter = document.getElementById('year-filter');
    const categoryFilter = document.getElementById('category-filter');
    
    // LES 1: TEMPLATE LITERAL met .map()
    const yearOptions = years.map(year => `<option value="${year}">${year}</option>`).join('');
    yearFilter.innerHTML += yearOptions;
    
    const categoryOptions = categories.map(cat => `<option value="${cat}">${cat}</option>`).join('');
    categoryFilter.innerHTML += categoryOptions;
};

// Update results teller
export const updateResultsCount = (count) => {
    const resultsCount = document.getElementById('results-count');
    // LES 1: TEMPLATE LITERAL
    resultsCount.textContent = `Showing ${count} ${count === 1 ? 'meme' : 'memes'}`;
};

// Toon/verberg loading
export const showLoading = () => {
    document.getElementById('loading').classList.remove('hidden');
    document.getElementById('meme-grid').classList.add('hidden');
};

export const hideLoading = () => {
    document.getElementById('loading').classList.add('hidden');
    document.getElementById('meme-grid').classList.remove('hidden');
};

// Toon error
export const showError = () => {
    document.getElementById('error').classList.remove('hidden');
    document.getElementById('loading').classList.add('hidden');
};

// Toon/verberg "geen resultaten"
export const showNoResults = () => {
    document.getElementById('no-results').classList.remove('hidden');
};

export const hideNoResults = () => {
    document.getElementById('no-results').classList.add('hidden');
};

// Animatie voor grid update
export const animateGridUpdate = () => {
    const grid = document.getElementById('meme-grid');
    grid.style.animation = 'none';
    void grid.offsetHeight;
    grid.style.animation = '';
};
