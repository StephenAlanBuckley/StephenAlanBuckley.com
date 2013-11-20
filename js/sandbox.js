var assoc_array = {};
assoc_array['key1'] = 5;

alert(Object.keys(assoc_array));

if (assoc_array.hasOwnProperty('key1')) {
  alert('yahoo! i have key1!');
}
