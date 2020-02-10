import IPresenter from '../Base/IPresenter';
import Room from '../../../../Domain/Entities/Room';

class FindByIdRoomPresenter implements IPresenter {
  private result: Room;
  constructor(result: Room) {
    this.result = result;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return { result: { name: this.result.Name, id: this.result.Id } };
  }
}

export default FindByIdRoomPresenter;
