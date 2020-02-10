import IPresenter from '../Base/IPresenter';
import Room from '../../../../Domain/Entities/Room';

class FindRoomPresenter implements IPresenter {
  private result: Room[];
  constructor(result: Room[]) {
    this.result = result;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return { result: this.result };
  }
}

export default FindRoomPresenter;
