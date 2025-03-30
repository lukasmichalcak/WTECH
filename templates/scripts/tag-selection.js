const tagInput = document.getElementById('tagInput');
const tagList = document.getElementById('tagList');
const addTagButton = document.getElementById('addTagButton');

// Store tags in a Set to prevent duplicates
const tags = new Set();

// Listed examples of tags
const suggestedTags = ['Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Tag 5', 'Tag 6', 'Tag 7', 'Tag 8', 'Tag 9', 'Tag 10', 'Tag 11'];
const suggestedContainer = document.getElementById('suggestedTags');

function createTagElement(text) {
    const tag = document.createElement('span');
    tag.className = 'badge rounded-pill bg-secondary d-flex align-items-center';
    tag.innerHTML = `
      <span class="me-2">${text}</span>
      <button type="button" class="btn-close btn-close-white btn-sm" aria-label="Remove tag"></button>
    `;

    // Remove tag on button click
    tag.querySelector('button').addEventListener('click', () => {
        tags.delete(text);
        tag.remove();
    });

    return tag;
}

function addTag() {
    const value = tagInput.value.trim();
    if (value && !tags.has(value)) {
        tags.add(value);
        const tagElement = createTagElement(value);
        tagList.appendChild(tagElement);
        tagInput.value = '';
    }
}

addTagButton.addEventListener('click', addTag);

tagInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        addTag();
    }
});

function renderSuggestedTags() {
    suggestedContainer.innerHTML = '';
    suggestedTags.forEach(tag => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        btn.textContent = tag;
        btn.addEventListener('click', () => {
            tagInput.value = tag;
            addTag();
        });
        suggestedContainer.appendChild(btn);
    });
}

// Call this once on load
renderSuggestedTags();