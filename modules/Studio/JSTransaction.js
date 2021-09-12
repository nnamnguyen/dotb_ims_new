

   
function JSTransaction(){
    this.JSTransactions = new Array();
    this.JSTransactionIndex = 0;
    this.JSTransactionCanRedo = false;
    this.JSTransactionTypes = new Array(); 
    

}

    JSTransaction.prototype.record = function(transaction, data){
        this.JSTransactions[this.JSTransactionIndex] = {'transaction':transaction , 'data':data};
        this.JSTransactionIndex++;
        this.JSTransactionCanRedo = false
    }
    JSTransaction.prototype.register = function(transaction, undo, redo){
        this.JSTransactionTypes[transaction] = {'undo': undo, 'redo':redo};
    }
    JSTransaction.prototype.undo = function(){
        if(this.JSTransactionIndex > 0){
            if(this.JSTransactionIndex > this.JSTransactions.length ){
                this.JSTransactionIndex  = this.JSTransactions.length;
            }
            var transaction = this.JSTransactions[this.JSTransactionIndex - 1];
            var undoFunction = this.JSTransactionTypes[transaction['transaction']]['undo'];
            undoFunction(transaction['data']);
            this.JSTransactionIndex--;
            this.JSTransactionCanRedo = true;
        }
    }
    JSTransaction.prototype.redo = function(){
        if(this.JSTransactionCanRedo && this.JSTransactions.length < 0)this.JSTransactionIndex = 0;
        if(this.JSTransactionCanRedo && this.JSTransactionIndex <= this.JSTransactions.length ){
            this.JSTransactionIndex++;
            var transaction = this.JSTransactions[this.JSTransactionIndex - 1];
            var redoFunction = this.JSTransactionTypes[transaction['transaction']]['redo'];
            redoFunction(transaction['data']);
        }
    }
