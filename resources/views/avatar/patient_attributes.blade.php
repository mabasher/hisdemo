
    <div class="container py-7">
        <div class="row">
            <div class="mx-auto bg-white rounded shadow animate__animated animate__fadeInLeft animate__fast">
                <div class="text-center mt-2">
                    <h4 class="text-success" id="bodyPartName"></h4>
                </div>
                <div class="table-responsive tabscroll">
                    <table class="table">
                        <tbody>
                            @foreach($avatarAttributes as $avat)
                            <tr>
                                <td width="60px"><input type="checkbox" value="{{$avat->atr_no}}" name="atr_no[]"></td>
                                <td >{{$avat->atr_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <!-- <button type="submit" class="btn btn-sm btn-success">Cheif Complaint</button> -->
                    <button href="javascript:void(0)" type="submit"  class="btn btn-sm btn-block btn-success" data-position="mb">
                            <span class="glyphicon glyphicon-retweet"></span>&nbsp; Cheif Complaint
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- <div class="container py-5">
    <div class="row">
        <div class="col-lg-7 mx-auto bg-white rounded shadow">
            <div class="table-responsive">
                <table class="table table-fixed">
                    <thead>
                        <tr rowspan="4">
                            <th>Location Of Body</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="col-3">1</th>
                            <td class="col-3">Mark</td>
                            <td class="col-3">Otto</td>
                            <td class="col-3">@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">2</th>
                            <td class="col-3">Jacob</td>
                            <td class="col-3">Thornton</td>
                            <td class="col-3">@fat</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">3</th>
                            <td colspan="2" class="col-6">Larry the Bird</td>
                            <td class="col-3">@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">4</th>
                            <td class="col-3">Martin</td>
                            <td class="col-3">Williams</td>
                            <td class="col-3">@Marty</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">5</th>
                            <td colspan="2" class="col-3">Sam</td>
                            <td colspan="2" class="col-3">Pascal</td>
                            <td class="col-3">@sam</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">6</th>
                            <td class="col-3">John</td>
                            <td class="col-3">Green</td>
                            <td class="col-3">@john</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">7</th>
                            <td colspan="2" class="col-3">David</td>
                            <td colspan="2" class="col-3">Bowie</td>
                            <td class="col-3">@david</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">8</th>
                            <td class="col-3">Pedro</td>
                            <td class="col-3">Rodriguez</td>
                            <td class="col-3">@rod</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">5</th>
                            <td colspan="2" class="col-3">Sam</td>
                            <td colspan="2" class="col-3">Pascal</td>
                            <td class="col-3">@sam</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">10</th>
                            <td class="col-3">Jacob</td>
                            <td class="col-3">Thornton</td>
                            <td class="col-3">@fat</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">11</th>
                            <td colspan="2" class="col-6">Larry the Bird</td>
                            <td class="col-3">@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div> -->