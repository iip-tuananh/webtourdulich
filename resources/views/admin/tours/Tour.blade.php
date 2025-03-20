
<script>
    class Tour extends BaseClass {
        no_set = [];
        all_categories = @json(\App\Model\Admin\Category::getForSelect());

        before(form) {
            this.image = {};
            this.image_back = {};
            this.status = 1;
        }

        after(form) {
        }

        get price() {
            return this._price ? this._price.toLocaleString('en') : '';
        }

        set price(value) {
            value = parseNumberString(value);
            this._price = value;
        }

        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

        get image_back() {
            return this._image_back;
        }

        set image_back(value) {
            this._image_back = new Image(value, this);
        }

        clearImage() {
            if (this.image) this.image.clear();
            if (this.image_back) this.image_back.clear();
        }


        get submit_data() {
            let data = {
                title_short: this.title_short,
                title: this.title,
                times: this.times,
                start_off: this.start_off,
                schedule: this.schedule,
                price: this._price,
                vehicle: this.vehicle,
                destination: this.destination,
                status: this.status,
                itinerary: this.itinerary,
                beware: this.beware,
                photos: this.photos,
                cate_id: this.cate_id,
            }

            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);
            let image_back = this.image_back.submit_data;
            if (image_back) data.append('image_back', image_back);

            return data;
        }
    }
</script>
