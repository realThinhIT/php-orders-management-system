$(function() {
  new AutoNumeric('input.number', { watchExternalChanges: true, decimalPlaces: 0 });
  new AutoNumeric('input[name="customer_paid"]', { decimalPlaces: 0 });
  new AutoNumeric('input[name="customer_return"]', { watchExternalChanges: true, decimalPlaces: 0 });
});