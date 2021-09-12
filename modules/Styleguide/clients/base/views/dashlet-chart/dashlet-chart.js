
({
    extendsFrom: 'OpportunityMetricsView',

    loadData: function (options) {
        if (this.meta.config) {
            return;
        }
        this.metricsCollection = {
          "won": {
            "amount_usdollar": 40000,
            "count": 4,
            "formattedAmount": "$30,000",
            "icon": "caret-up",
            "cssClass": "won",
            "dealLabel": "won",
            "stageLabel": "Won"
          },
          "lost": {
            "amount_usdollar": 10000,
            "count": 1,
            "formattedAmount": "$10,000",
            "icon": "caret-down",
            "cssClass": "lost",
            "dealLabel": "lost",
            "stageLabel": "Lost"
          },
          "active": {
            "amount_usdollar": 30000,
            "count": 3,
            "formattedAmount": "$30,000",
            "icon": "minus",
            "cssClass": "active",
            "dealLabel": "active",
            "stageLabel": "Active"
          }
        };
        this.chartCollection = {
          "data": [
            {
              "key": "Won",
              "value": 4,
              "classes": "won"
            },
            {
              "key": "Lost",
              "value": 1,
              "classes": "lost"
            },
            {
              "key": "Active",
              "value": 3,
              "classes": "active"
            }
          ],
          "properties": {
            "title": "Opportunity Metrics",
            "value": 8,
            "label": 8
          }
        };
        this.total = 8;
    }
})
