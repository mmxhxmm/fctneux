// Will apply to all form empresa pages
document.addEventListener('DOMContentLoaded', function () {
    // TODO: just remove all this man, look at it. What a disgrace
    // This only applies for 1:1 not 1:N so it won't matter
    // Change it for 1:N of course, but there's mo frontend for that yet

    const secondarySection = document.getElementById('secondary_section');
    const tertiarySection = document.getElementById('tertiary_section');
    const quaternarySection = document.getElementById('quaternary_section');

    // Only proceed if sections exist
    if (!secondarySection || !tertiarySection || !quaternarySection) return;

    const requiredFields = secondarySection.querySelectorAll('.section_required');

    // document.getElementById('add_section_button_1').addEventListener('click', showSection());
    const button1 = document.getElementById('add_section_button_1');
    if (button1) {
        button1.addEventListener('click', function() {
            toggleSection(secondarySection, 'add_section_button_1', requiredFields);
        });
    }

    const button2 = document.getElementById('add_section_button_2');
    if (button2) {
        button2.addEventListener('click', function() {
            toggleSection(tertiarySection, 'add_section_button_2', requiredFields);
        });
    }

    const button3 = document.getElementById('add_section_button_3');
    if (button3) {
        button3.addEventListener('click', function() {
            toggleSection(quaternarySection, 'add_section_button_3', requiredFields);
        });
    }
    
    function showSection(section, button) {
        if (!section || !button) return;
        if (section.style.display !== 'block') {
            // Show Area
            section.style.display = 'block';
            document.getElementById(button).textContent = " - ";
            requiredFields.forEach(function (field) {
                field.required = true;
                field.disabled = false;
            });
        } else {
            // Hide Area
            section.style.display = 'none';
            document.getElementById(button).textContent = " + ";
            requiredFields.forEach(function (field) {
                field.required = false;
                field.disabled = true;
            });
        }
    }
    showSection();
});