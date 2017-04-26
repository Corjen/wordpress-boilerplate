import FontFaceObserver from 'fontfaceobserver'
export default () => {
  const font = new FontFaceObserver('') // Add font here
  font.load().then(() => {
    if (!document.documentElement.classList.contains('fonts-loaded')) {
      document.documentElement.classList.add('fonts-loaded')
    }
  })
}
