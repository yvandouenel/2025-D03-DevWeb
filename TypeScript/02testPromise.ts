function iReturnPromiseAfter1Second(): Promise<number> {
  return new Promise((resolve, reject) => {
    setTimeout(() => resolve(1), 1000);
  });
}
(async () => {
  const result = await iReturnPromiseAfter1Second();
  console.log(result);
})();
