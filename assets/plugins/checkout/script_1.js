const createStore = Redux.createStore;
const Button = ReactBootstrap.Button;
const ACTION_SEAT_CLICK = "SEAT_CLICK";
const ACTION_ORDER = "ORDER";
const ACTION_PRICE_CHANGE_CLICK = "PRICE_CHANGE_CLICK";
const ROW_SEAT_DELIMITER = "-";

const data = {
  "id": "2016-03-28T19:00",
  "title": "Bus",
  "rows": [
  { "row": "1", "seats": [ "1", "2", "3", "4" ] },
  { "row": "2", "seats": [ "5", "6", "7", "8" ] },
  { "row": "3", "seats": [ "9", "10", "11", "12" ] },
  { "row": "4", "seats": [ "13", "14", "15", "16" ] },
  { "row": "5", "seats": [ "17", "18", "19", "20" ] },
  { "row": "6", "seats": [ "21", "22", "23", "24" ] },
  { "row": "7", "seats": [ "25", "26" ] },
  { "row": "8", "seats": [ "27", "28", "29", "30" ] },
  { "row": "9", "seats": [ "31", "32", "33", "34" ] },
  { "row": "10", "seats": [ "35", "36", "37", "38" ] },
  { "row": "11", "seats": [ "39", "40", "41", "42" ] },
  { "row": "12", "seats": [ "43", "44", "45", "46" ] },
  { "row": "13", "seats": [ "47", "48", "49", "50" ] },
  { "row": "14", "seats": [ "51", "52", "53", "54" ] },
  { "row": "15", "seats": [ "55", "56", "57", "58", "59" ] } ],

  "status": {
    "1": { "1": 1, "2": 1, "3": 1, "4": 1 },
    "2": { "5": 1, "6": 1, "7": 1, "8": 1 },
    "3": { "9": 1, "10": 1, "11": 1, "12": 1 },
    "4": { "13": 1, "14": 1, "15": 1, "16": 1 },
    "5": { "17": 0, "18": 1, "19": 1, "20": 1 },
    "6": { "21": 1, "22": 1, "23": 1, "24": 1 },
    "7": { "25": 1, "26": 1 },
    "8": { "27": 1, "28": 1, "29": 1, "30": 1 },
    "9": { "31": 0, "32": 1, "33": 1, "34": 1 },
    "10": { "35": 1, "36": 1, "37": 1, "38": 1 },
    "11": { "39": 1, "40": 1, "41": 1, "42": 1 },
    "12": { "43": 1, "44": 1, "45": 1, "46": 1 },
    "13": { "47": 1, "48": 1, "49": 1, "50": 1 },
    "14": { "51": 1, "52": 1, "53": 1, "54": 1 },
    "15": { "55": 1, "56": 1, "57": 1, "58": 1, "59": 1 } },

    "prices": {
      "1": 900.00,
      "0": "Продані"},
  
    reserved: [] };

let discount = [
  { value: '0', text: 'немає' }, 
  { value: '5', text: 'Діти: від 0 до 5р 5%' }, 
  { value: '10', text: 'Персіонер 10%' },
  { value: '15', text: 'Студент 15%' },
  { value: '18', text: 'VIP 18%' } ]

function cloneState(state) {
  return JSON.parse(JSON.stringify(state));
}

function formatCurrency(price) {
  return price.toLocaleString('uk-UA', { style: 'currency', currency: 'UAH' });
}

function seatClick(rowNo, seatNo, price) {
  store.dispatch({
    type: ACTION_SEAT_CLICK,
    rowNo,
    seatNo,
    price });
}

function priceChangeClick(item, priceTicket){
  store.dispatch({
    type: ACTION_PRICE_CHANGE_CLICK,
    item,
    priceTicket });
}

function order() {
  store.dispatch({
    type: ACTION_ORDER });
}

function booking(state = data, action) {
  switch (action.type) {

    case ACTION_SEAT_CLICK:
      const combRowSeat = action.rowNo + ROW_SEAT_DELIMITER + action.seatNo;
      const stateNew = cloneState(state);
      if (stateNew.reserved.length !== 0) {
        const index = stateNew.reserved.findIndex(x => x.item === combRowSeat);

        if (index >= 0) {
          stateNew.reserved.splice(index, 1);
        } else {
          stateNew.reserved.push({item: combRowSeat, priceItem: action.price});
        }
      } else {
        stateNew.reserved = [{item: combRowSeat, priceItem: action.price}];
      }
      return stateNew;

    case ACTION_ORDER:
      let stateAfterOrder = cloneState(state);
      stateAfterOrder.reserved.map(function (combRowSeat) {
        const rowNo = combRowSeat.item.toString().split(ROW_SEAT_DELIMITER)[0];
        const seatNo = combRowSeat.item.toString().split(ROW_SEAT_DELIMITER)[1];
        stateAfterOrder.status[rowNo][seatNo] = -stateAfterOrder.status[rowNo][seatNo];
      });
      stateAfterOrder.reserved = [];
      return stateAfterOrder;

    case ACTION_PRICE_CHANGE_CLICK:
      const item = action.item;
      const priceTicket = action.priceTicket;
      const st = cloneState(state);
      st.reserved[item].priceItem = priceTicket;
      return st;

    default:
      return state;}
}

class Seat extends React.Component {
  render() {
    const rowNo = this.props.rowNo;
    const seatNo = this.props.seatNo;
    
    const category = seatNo ? this.props.status : 0;
    const combRowSeat = rowNo + ROW_SEAT_DELIMITER + seatNo;
    const reserved = store.getState().reserved.findIndex(x => x.item === combRowSeat) >= 0;

    const cat = store.getState().status[rowNo][seatNo];
    const price = store.getState().prices[cat];
    
    const status = category == 0 || seatNo == "r" ? "" : reserved ? "reserved" : category < 0 ? "booked" : "free";
    return (
      React.createElement("div", { className: "seat seat-category-" + (seatNo == "r" ? "r" : category) + (status ? " seat-status-" + status : ""),
        onClick: category <= 0 ? "" : function onClick() {
          seatClick(rowNo, seatNo, price);} },
      seatNo == "r" ? rowNo : seatNo ? seatNo : "-"));
  }}
;

class Row extends React.Component {
  render() {
    const rowNo = this.props.rowNo;
    const seats = this.props.seats;
    const status = this.props.status;
    return (
      React.createElement("div", null,
      seats.map(function (seatNo, index) {
        return React.createElement(Seat, { rowNo: rowNo, seatNo: seatNo, status: status[seatNo], key: index });
      })));
  }}
;

class Stage extends React.Component {
  render() {
    const firstRow = this.props.firstRow;
    let numberOfSeats = firstRow.length;
    let i = 0;
    while (i < firstRow.length && (firstRow[i] == "" || firstRow[i] == "r")) {
      numberOfSeats--;
      i++;
    }
    i = firstRow.length - 1;
    while (i >= 0 && (firstRow[i] == "" || firstRow[i] == "r")) {
      numberOfSeats--;
      i--;
    }
    return (
      React.createElement("div", { className: "stage none-element", style: { width: numberOfSeats * 24 } }, "BUS"));
  }}


class Theatre extends React.Component {
  render() {
    const rows = this.props.rows;
    const status = this.props.status;
    return (
      React.createElement("div", { className: "theatre" },
      React.createElement(Stage, { firstRow: rows[0].seats }),
      rows.map(function (rowData, index) {
        const rowNo = rowData.row;
        return React.createElement(Row, { rowNo: rowNo, seats: rowData.seats, status: status[rowNo], key: index });
      })));
  }};


class ReservedOneSeat extends React.Component {
  
  constructor(props) {
    super(props);
    this.state = { value: '0', update: false };

    this.handleChange = this.handleChange.bind(this);
  }

  handleChange(event) {
    const priceTicket = event.target.value == 0 ? this.props.originPrice : this.props.originPrice - (this.props.originPrice * (event.target.value) / 100);
    priceChangeClick(this.props.item, priceTicket);
    this.setState({ value: event.target.value});
  }

  render() {
    const rowNo = this.props.rowNo;
    const seatNo = this.props.seatNo;
    const priceTicket = formatCurrency(this.props.price)

    return (
      React.createElement("div", { className: "reserved-seat" },

        React.createElement("div", { className: "row" },
          React.createElement("div", { className: "col-sm-12 wp-for-delete-button" },
            React.createElement("div", {
              className: "reserved-seat-category seat-category-",
              onClick: function onClick() {
                 seatClick(rowNo, seatNo); }
            },
              "X")
          ),

          React.createElement("div", { className: "col-sm-6" },
            React.createElement('label', {}, 'І\'мя'),
            React.createElement("input", { className: "form-control" , required: "required"}),
          ),

          React.createElement("div", { className: "col-sm-6" },
            React.createElement('label', {}, 'Прізвище'),
            React.createElement("input", { className: "form-control", required: "required" }),
          ),

          React.createElement("div", { className: "col-sm-6" },
            React.createElement('label', {}, 'Phone'),
            React.createElement("input", { className: "form-control", type: "tel", required: "required" }),
          ),

          React.createElement("div", { className: "col-sm-6" },
            React.createElement('label', {}, 'Email'),
            React.createElement("input", { className: "form-control", type: "email", required: "required" }),
          ),

          React.createElement("div", { className: "col-sm-12" },
          React.createElement('label', {}, 'Знижка'),
          React.createElement("div", { className: "fl-box"},
          
          React.createElement("select", { value: this.state.value, onChange: this.handleChange, className: "form-control" },
          discount.map(option => {
            return React.createElement("option", { value: option.value, key: option.value }, option.text);            
          })),
        //  React.createElement("pre", null, this.state.value)
          
          )),

          React.createElement("div", { className: "col-sm-6 place-price" },
            React.createElement("b", null, seatNo), " Місце ",
          ),
          React.createElement("div", { className: "col-sm-6 place-price" },
            React.createElement("label", {}, " Ціна ", priceTicket)),
            
        )));
  }
};


class ReservedSeats extends React.Component {
  render() {
    const reserved = this.props.reserved;
    let total = 0;
    return (
      React.createElement("div", { className: "reserved-seats" },
      
      reserved.map(function (combRowSeat, i) {
        if(Object.entries(combRowSeat).length !== 0 || combRowSeat.constructor !== Object){

          const rowNo = combRowSeat.item.toString().split(ROW_SEAT_DELIMITER)[0];
          const seatNo = combRowSeat.item.toString().split(ROW_SEAT_DELIMITER)[1];
          const category = store.getState().status[rowNo][seatNo];

          const originPrice = store.getState().prices[category];
          const price = combRowSeat.priceItem;
          
          total += price;                            

          return React.createElement(ReservedOneSeat, {rowNo: rowNo, seatNo: seatNo,
            category: category, price: price, item: i, originPrice,
            key: "reserved-seat-" + i });
      } return false}),

      React.createElement("div", { className: "row" },
      React.createElement("div", { className: "col-sm-12" },

      React.createElement("div", { className: "reserved-total" },
      React.createElement("span", { className: "reserved-total-label" }, "Сума:"),      
      React.createElement("span", { className: "reserved-total-price" }, formatCurrency(total)
      ))))));
  }};


class App extends React.Component {
  render() {
    return (
      React.createElement("div", { className: "container-fluid app" },
      React.createElement("div", { className: "row" },
      React.createElement("div", { className: "col-sm-6" },
            React.createElement("div", { className: "tr-single-box" },
      React.createElement("div", { className: "tr-single-body" },

      React.createElement("div", { className: "booking-price-detail side-list no-border" },
      
      React.createElement("ul", { className: "booking-price-detail-item" },      
      React.createElement("span", { }, "Дата відправки:"),
      React.createElement("strong", { className: "pull-right" }, "08.01.2020")),

      React.createElement("ul", { className: "booking-price-detail-item" },      
      React.createElement("span", { }, "Місто відправки:"),
      React.createElement("strong", { className: "pull-right" }, "Івано-Франківськ")),

      React.createElement("ul", { className: "booking-price-detail-item" },      
      React.createElement("span", { }, "Місто прибуття:"),
      React.createElement("strong", { className: "pull-right" }, "Варшава")),
      ),

      React.createElement(Theatre, { rows: store.getState().rows, status: store.getState().status })))),
      React.createElement("div", { className: "col-sm-6" },
      React.createElement("div", { className: "tr-single-box" },
      React.createElement("div", { className: "tr-single-body" },
      React.createElement("form", { className: "form", "data-validate": "parsley", onSubmit: (e) => { e.preventDefault(); order()}},
      React.createElement(ReservedSeats, { reserved: store.getState().reserved }),
      React.createElement("div", null,

     // React.createElement(Button, { bsStyle: "primary", type: "submit" }, "Оплатити"),
      
      React.createElement("div", { className: "payment-card wp-types-of-payment" },
      React.createElement("header", { className: "payment-card-header cursor-pointer", 
      "data-toggle": "collapse", "data-target": "#debit-credit", "aria-expanded": "true"},

      React.createElement("div", { className: "payment-card-title flexbox" },
      React.createElement("h4", { }, "Оплатити онлайн" )),

      React.createElement("div", { className: "pull-right" },
      React.createElement("img", { src: "https://mlp-bus.com/img/visa.png", alt: "logo"},
      React.createElement("img", { src: "https://mlp-bus.com/img/mastercard.png", alt: "logo"} )))
      ),

      React.createElement("div", { className: "collapse", id: "debit-credit", "aria-expanded":"false" },
      React.createElement("div", { className: "payment-card-body" },
      React.createElement("div", { className: "booking-price-detail side-list no-border" },
      React.createElement("ul", { },
      React.createElement("li", { }, "Сума до оплати",
      React.createElement("strong", { className: "theme-cl pull-right" }, "1170 грн.",
      )))),

      //React.createElement("form", { "data-validate": "parsley" },
      React.createElement("div", { className: "wp-personal-data" },

      React.createElement("input", { className: "parsley-validated", "type": "checkbox", "id": "checkBooking", "name": "checkBooking",
      "value": "option1", "data-required": "true", "data-error-message": "Ви повинні погодитися з політикою сайту." }),

      React.createElement("label", { for: "checkBooking"}, "Я приймаю",
      React.createElement("a", { href: "personal-data.html",
      className: "btn-signup red-btn", target: "_blank" }, "умови обробки персональних даних"      
      ))
      // )
      ),


      React.createElement("div", { className: "wp-success" },
      React.createElement(Button, { className: "btn btn-m btn-success", type: "submit" }, "Оплатити")
      )

      ))
      
      ) ))))))));
  }};

function render() {
  ReactDOM.render(
  React.createElement(App, null),
  document.getElementById('app'));
}

const store = createStore(booking);
render();
store.subscribe(render);