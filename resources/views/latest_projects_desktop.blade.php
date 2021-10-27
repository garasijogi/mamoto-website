<div class="al-dp desktop">
  @foreach ($displayed_portfolios as $index => $dp)
      @if (!empty($dp->portfolio))
          <a href="/portfolio/{{ $dp->portfolio->pfType_id }}/{{ $dp->portfolio->slug }}"
              class="d-block text-decoration-none" data-aos="fade-{{ $index % 2 != 0 ? 'left' : 'right' }}">
              <div class="row al-dp-card {{ $index > 0 ? 'py-5' : 'pb-5 pt-3' }}">
                  @if ($index % 2 != 0)
                      <div class="col-4 align-self-center">
                          <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                              @switch($dp->pfType_id)
                                  @case('W')
                                      Wedding
                                  @break
                                  @case('preW')
                                      Pre-Wedding
                                  @break
                                  @case('S')
                                      Siraman/Pengajian
                                  @break
                                  @case('L')
                                      Lamaran
                                  @break
                                  @default
                                      Data not found.
                              @endswitch
                          </h6>
                          <h3 class="py-2 text-center al-font-portfolio-name al-grey-color">
                              {{ $dp->portfolio->name }}</h3>
                          <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                              {{ date('d . m . Y', strtotime($dp->portfolio->date)) }}
                              |{{ $dp->portfolio->location }}
                          </h6>
                      </div>
                  @else
                      <div class="col-8 text-right">
                          @foreach (array_slice(json_decode($dp->portfolio->photo), 0, 1) as $photo)
                              <img width='700px' height='400px' style='object-fit:cover;'
                                  class="al-portfolio-card-preview"
                                  src="/storage/images/portfolio/{{ $dp->pfType_id }}/{{ $dp->portfolio->slug }}/{{ $photo->name }}"
                                  alt=" Card image cap">
                          @endforeach
                      </div>
                  @endif
                  @if ($index % 2 != 0)
                      <div class="col-8 text-right">
                          @foreach (array_slice(json_decode($dp->portfolio->photo), 0, 1) as $photo)
                              <img width='700px' height='400px' style='object-fit:cover;'
                                  src="/storage/images/portfolio/{{ $dp->pfType_id }}/{{ $dp->portfolio->slug }}/{{ $photo->name }}"
                                  alt=" Card image cap">
                          @endforeach
                      </div>
                  @else
                      <div class="col-4 align-self-center">
                          <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                              @switch($dp->pfType_id)
                                  @case('W')
                                      Wedding
                                  @break
                                  @case('preW')
                                      Pre-Wedding
                                  @break
                                  @case('S')
                                      Siraman/Pengajian
                                  @break
                                  @case('L')
                                      Lamaran
                                  @break
                                  @default
                                      Data not found.
                              @endswitch
                          </h6>
                          <h3 class="py-2 text-center al-font-portfolio-name al-grey-color">
                              {{ $dp->portfolio->name }}</h3>
                          <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                              {{ date('d . m . Y', strtotime($dp->portfolio->date)) }}
                              | Jakarta Barat
                          </h6>
                      </div>
                  @endif
              </div>
          </a>
      @endif
  @endforeach
</div>