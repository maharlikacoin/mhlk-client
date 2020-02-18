<style src="./annotationLayer.css"></style>
<script>

	import componentFactory from './componentFactory.js'

    let component = componentFactory({});
	if ( process.env.VUE_ENV !== 'server' ) {

		let pdfjsWrapper = require('./pdfjsWrapper.js').default;
		let PDFJS = require('pdfjs-dist/build/pdf.js');

		if ( typeof window !== 'undefined' && 'Worker' in window && navigator.appVersion.indexOf('MSIE 10') === -1 ) {

			let PdfjsWorker = require('worker-loader!pdfjs-dist/build/pdf.worker.js');
			PDFJS.GlobalWorkerOptions.workerPort = new PdfjsWorker();
		}

		component = componentFactory(pdfjsWrapper(PDFJS));
	}

	export default component;
</script>
