
//Singleton
var FieldPanelItemFactory = (function () {
	var products = {
		"button": FieldPanelButton,
		"buttongroup": FieldPanelButtonGroup,
		"list": ListPanel,
		"form": FormPanel,
		"multiple": MultipleCollapsiblePanel,
		"item_container": ItemContainer
	};
	return {
		hasProduct: function (productName) {
			return !!products[productName];
		},
		canProduce: function (productClass) {
			var key;
			for (key in products) {
				if(products.hasOwnProperty(key)) {
					if(products[key] === productClass) {
						return true;
					}
				}
			}
			return false;
		},
		isProduct: function(productObject) {
			var key;
			for (key in products) {
				if(products.hasOwnProperty(key)) {
					if(productObject instanceof products[key]) {
						return true;	
					}
				}
			}
			return false;	
		},
		make: function(settings) {
			var productName = settings.type, Constructor;
			if(!this.hasProduct(productName)) {
				throw new Error("make(): The product \"" + productName + "\" can't be produced by this factory.");
			}
			Constructor = products[productName];
			return new Constructor(settings);
		}
	};
}());