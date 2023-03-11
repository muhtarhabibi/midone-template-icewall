import { createIcons, icons } from "lucide";

(function () {
    "use strict";

    // Lucide Icons
    createIcons({
        icons,
        // "stroke-width": 1.5,
        // attrs: {
        //     class: ['my-custom-class', 'icon'],
        //     'stroke-width': 1,
        //     stroke: '#333'
        //   },
        nameAttr: "icon-name",
    });
    window.lucide = {
        createIcons: createIcons,
        icons: icons,
    };
})();
