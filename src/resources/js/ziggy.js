const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"dashboard":{"uri":"\/","methods":["GET","HEAD"]},"scans.index":{"uri":"scans","methods":["GET","HEAD"]},"scans.create":{"uri":"scans\/create","methods":["GET","HEAD"]},"scans.store":{"uri":"scans","methods":["POST"]},"scans.show":{"uri":"scans\/{scan}","methods":["GET","HEAD"],"parameters":["scan"]},"scans.destroy":{"uri":"scans\/{scan}","methods":["DELETE"],"parameters":["scan"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
