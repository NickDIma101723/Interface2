
export const fetchMemes = async () => {
    try {
        // LES 4: await wacht op fetch (net als in Opdracht 7A/7B/7C)
        const response = await fetch('./memes.json');
        
        // LES 4: await wacht op .json() Promise
        const data = await response.json();
        
        return data;
        
    } catch (error) {
        // LES 4: try/catch voor foutafhandeling
        console.error('Er ging iets mis:', error);
        throw error;
    }
};

// LES 1: ARROW FUNCTION
// Deze functie haalt unieke jaren uit de memes
export const getUniqueYears = (memes) => {
    // LES 1: CONST voor variabele die niet verandert
    const years = memes.map(meme => meme.year);
    const uniqueYears = [...new Set(years)];
    return uniqueYears.sort();
};

// LES 1: ARROW FUNCTION  
// Deze functie haalt unieke categorieën uit de memes
export const getUniqueCategories = (memes) => {
    const categories = memes.map(meme => meme.category);
    const uniqueCategories = [...new Set(categories)];
    return uniqueCategories.sort();
};
