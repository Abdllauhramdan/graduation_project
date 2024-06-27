import algoliasearch from 'algoliasearch/lite';
import instantsearch from 'instantsearch.js';
import { searchBox, hits, configure } from 'instantsearch.js/es/widgets';
import { getPropertyByPath } from 'instantsearch.js/es/lib/utils';

const searchClient = algoliasearch('4POUCLHWLB', '7d6b984198d804057c3941c4e1a9be47');

const search = instantsearch({
  indexName: 'medicines',
  searchClient,
});

search.addWidgets([
  searchBox({
    container: "#searchbox"
  }),
  configure({
    hitsPerPage: 5
  }),
  hits({
    container: "#hits",
    templates: {
      item: (hit, { html, components }) => html`
        <div>
          <div class="hit-name">
					  ${components.Highlight({ hit, attribute: "name" })}
					</div>
					<div class="hit-company_name">
					  ${components.Highlight({ hit, attribute: "company_name" })}
					</div>
					<div class="hit-category">
					  <span>${getPropertyByPath(hit, 'category')}</span>
					</div>
        </div>
      `,
    },
  }),
]);

export default search;


// import search from "./search.js";
// import 'instantsearch.css/themes/satellite.css';

// search.start();