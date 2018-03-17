import jsPDF from "jspdf";

export default {
  methods: {
    canvas() {
      return this.$refs.canvas;
    },

    asImage() {
      return this.canvas().toDataURL();
    },

    asPDF() {
      var doc = new jsPDF('landscape');
      doc.setFontSize(20);
      doc.addImage(this.asImage(), 'PNG', 10, 10, 280, 150);
      doc.save('report.pdf');
    }
  }
}