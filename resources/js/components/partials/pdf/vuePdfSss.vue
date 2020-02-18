<style src="./annotationLayer.css"></style>
<script>

	import componentFactory from './componentFactory'
	import pdfjsWrapper from './pdfjsWrapper'

	let PDFJS = require('pdfjs-dist/build/pdf.js');

	if ( process.env.VUE_ENV !== 'server' ) {

		if ( typeof window !== 'undefined' && 'Worker' in window ) {

			let PdfjsWorker = require('worker-loader!pdfjs-dist/build/pdf.worker.js');
			PDFJS.GlobalWorkerOptions.workerPort = new PdfjsWorker();
		}
	}

	let component = componentFactory(pdfjsWrapper(PDFJS));
	component.PDFJS = PDFJS;

	export default component;

</script>
