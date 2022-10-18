/*
 * This ambient module is needed so that webpack knows how to import vue files.
 * How exactly it helps, I don't know. If you know, please add a PR to amend this comment, thanks :)
 */
declare module '*.vue' {
	import type { DefineComponent } from 'vue'
	const component: DefineComponent<{}, {}, any>
	export default component
}
