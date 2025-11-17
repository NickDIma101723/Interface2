
export const filterBySearch = (memes, searchTerm) => {
    if (!searchTerm) {
        return memes;
    }
    
    // LES 1: CONST
    const lowerSearch = searchTerm.toLowerCase();
    
    return memes.filter(meme => 
        meme.title.toLowerCase().includes(lowerSearch) ||
        meme.description.toLowerCase().includes(lowerSearch)
    );
};

// LES 1: ARROW FUNCTION - filter op jaar
export const filterByYear = (memes, year) => {
    if (year === 'all') {
        return memes;
    }
    
    return memes.filter(meme => meme.year === parseInt(year));
};

// LES 1: ARROW FUNCTION - filter op categorie
export const filterByCategory = (memes, category) => {
    if (category === 'all') {
        return memes;
    }
    
    return memes.filter(meme => meme.category === category);
};

// Pas alle filters toe
export const applyAllFilters = (memes, filters) => {
    // LES 1: LET omdat filtered steeds verandert
    let filtered = memes;
    
    filtered = filterBySearch(filtered, filters.search);
    filtered = filterByYear(filtered, filters.year);
    filtered = filterByCategory(filtered, filters.category);
    
    return filtered;
};

// Haal huidige filter waarden op
export const getCurrentFilters = () => {
    return {
        search: document.getElementById('search-input').value,
        year: document.getElementById('year-filter').value,
        category: document.getElementById('category-filter').value
    };
};

// Reset alle filters
export const resetFilters = () => {
    document.getElementById('search-input').value = '';
    document.getElementById('year-filter').value = 'all';
    document.getElementById('category-filter').value = 'all';
};
