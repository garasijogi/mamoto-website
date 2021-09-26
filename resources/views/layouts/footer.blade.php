<footer>
    <div class="row">
        <div class="col-6 d-flex justify-content-center">
            <div class="text-center">
                <img class="al-footer-img" src="/images/hipdi_logo.png" width="120px" height="120px" style="object-fit: contain">
                <p class="al-grey-color pt-2">Terdaftar di Himpunan Pengusaha Dokumentasi Indonesia <br>HIPDI</p>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-center">
            <div class="text-center">
                <img class="al-footer-img" src="/images/cv_logo.svg" width="120px" height="120px">
                <p class="al-grey-color pt-2">Terdaftar sebagai CV di Kementerian Hukum dan HAM <br>(Kemenkunham)</p>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ $socmed['bridestory']->link . $socmed['bridestory']->contact }}" target="_blank">
                <img src="/images/bridestory_logo.png" width="100px" height="30px" style="object-fit: contain">
            </a>
        </div>
        <div class="col-12 pt-0 pb-5 d-flex justify-content-center">
            @if ($socmed['youtube'])
                <a href="{{ $socmed['youtube']->link . $socmed['youtube']->contact }}" target="_blank">
                    <img class="al-icon-footer mx-3" src="/images/youtube_logo.svg" width="37px" height="37px" style="object-fit: contain">
                </a>
            @endif
            @if ($socmed['email'])
                <a href="{{ $socmed['email']->link . $socmed['email']->contact }}" target="_blank">
                    <img class="al-icon-footer mx-3" src="/images/mail_logo.svg" width="37px" height="37px" style="object-fit: contain">
                </a>
            @endif
            @if ($socmed['instagram'])
                <a href="{{ $socmed['instagram']->link . $socmed['instagram']->contact }}" target="_blank">
                    <img class="al-icon-footer mx-3" src="/images/ig_logo.svg" width="37px" height="37px" style="object-fit: contain">
                </a>
            @endif
            @if ($socmed['facebook'])
                <a href="{{ $socmed['facebook']->link . $socmed['facebook']->contact }}" target="_blank">
                    <img class="al-icon-footer mx-3" src="/images/fb_logo.svg" width="37px" height="37px" style="object-fit: contain">
                </a>
            @endif
        </div>
        <div class="col-12 text-center">
            <p class="al-grey-color">&copy 2021 <span class="font-weight-bold">Mamoto Picture.</span> garasijogi</p>
        </div>
    </div>
</footer>