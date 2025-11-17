
import { fetchMemes, getUniqueYears, getUniqueCategories } from './api.js';
import { renderMemes, populateFilters, showLoading, hideLoading, showError, animateGridUpdate } from './ui.js';
import { applyAllFilters, getCurrentFilters, resetFilters } from './filters.js';

// LES 1: LET - deze variabele verandert later
let allMemes = [];

// LES 4: ASYNC FUNCTION - vergelijkbaar met Opdracht 7A/7B/7C
const init = async () => {
    try {
        showLoading();
        
        // LES 4: AWAIT - wacht op data (zoals in de opdrachten)
        allMemes = await fetchMemes();
        
        // LES 1: CONST - deze variabelen veranderen niet
        const years = getUniqueYears(allMemes);
        const categories = getUniqueCategories(allMemes);
        
        populateFilters(years, categories);
        hideLoading();
        renderMemes(allMemes);
        
        setupEventListeners();
        
    } catch (error) {
        // LES 4: TRY/CATCH - zoals in Opdracht 7A/7B/7C
        console.error('Er ging iets mis:', error);
        showError();
    }
};

// Setup event listeners
const setupEventListeners = () => {
    // LES 1: CONST
    const searchInput = document.getElementById('search-input');
    const yearFilter = document.getElementById('year-filter');
    const categoryFilter = document.getElementById('category-filter');
    const resetButton = document.getElementById('reset-filters');
    
    // LES 1: ARROW FUNCTION
    const handleFilterChange = () => {
        const filters = getCurrentFilters();
        const filteredMemes = applyAllFilters(allMemes, filters);
        renderMemes(filteredMemes);
        animateGridUpdate();
    };
    
    // LES 1: ARROW FUNCTION
    const handleReset = () => {
        resetFilters();
        renderMemes(allMemes);
        animateGridUpdate();
    };
    
    // Event listeners
    searchInput.addEventListener('input', handleFilterChange);
    yearFilter.addEventListener('change', handleFilterChange);
    categoryFilter.addEventListener('change', handleFilterChange);
    resetButton.addEventListener('click', handleReset);
    
    // Bonus: Escape key reset
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            handleReset();
        }
    });
};

// Start app wanneer pagina geladen is
document.addEventListener('DOMContentLoaded', init);
