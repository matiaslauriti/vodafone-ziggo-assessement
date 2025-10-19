const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"scans.index":{"uri":"scans","methods":["GET","HEAD"]},"scans.store":{"uri":"scans","methods":["POST"]},"scans.in-progress":{"uri":"scans\/in-progress","methods":["GET","HEAD"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
