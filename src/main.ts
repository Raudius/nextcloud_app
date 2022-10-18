import { generateFilePath } from '@nextcloud/router'
import SampleView from './views/SampleView.vue';
import Vue from "vue";

declare let appName: string
// eslint-disable-next-line
declare let __webpack_public_path__: string;
// eslint-disable-next-line
__webpack_public_path__ = generateFilePath(appName, '', 'js/')

const div = document.createElement('div')
div.id = 'attach_div_' + appName
document.body.appendChild(div)

new Vue({ // eslint-disable-line no-new
	el: '#' + div.id,
	render: h => h(SampleView),
})
